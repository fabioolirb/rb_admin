<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrizTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriz', function (Blueprint $table) {
            $table->integer('id')->increment();
            $table->string('linha');
            $table->string('coluna');
            $table->integer('produto_id');
            $table->integer('quantidade');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('produto_id')->references('id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('matriz');
    }
}
