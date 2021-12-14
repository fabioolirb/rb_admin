<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nome');
            $table->string('referencia');
            $table->integer('prazo_producao');
            $table->integer('categoria_id');
            //$table->foreign('categoria_id')->references('id')->on('categoria');
            $table->engine = 'InnoDB';
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
        Schema::drop('produtos');
    }
}
