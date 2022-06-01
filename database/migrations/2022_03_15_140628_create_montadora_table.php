<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMontadoraTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('montadora', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('ddd');
            $table->integer('fone');
            $table->string('contrato');
            $table->string('logradouro');
            $table->string('bairro');
            $table->string('nr');
            $table->integer('cidade_id');
            $table->integer('estado_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('montadora');
    }
}
