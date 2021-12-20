<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagemProdutosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagem_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->longText('link');
            $table->integer('produto_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('produto_id')->references('id')->on('produtos');
        });



        Schema::create('imagem_cors',function (Blueprint $table){
            $table->increments('id');
            $table->integer('imagem_id');
            $table->integer('cor_id');

            $table->foreign('cor_id')
                ->references('id')
                ->on('cors')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imagem_produtos');
        Schema::drop('imagem_cors');
    }
}
