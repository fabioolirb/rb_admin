<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducaosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producaos', function (Blueprint $table) {
            $table->integer('id')->increment();
            $table->date('data_ini');
            $table->date('data_fim');
            $table->integer('imagem_id');
            $table->integer('maquina_id');
            $table->integer('turno_id');
            $table->integer('operador_id');
            $table->softDeletes();
            $table->foreign('imagem_id')->references('id')->on('imagem_produtos');
            $table->foreign('maquina_id')->references('id')->on('maquinas');
            $table->foreign('turno_id')->references('id')->on('turnos');
            $table->foreign('operador_id')->references('id')->on('operadors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('producaos');
    }
}
