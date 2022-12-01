<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCelulaTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celula', function (Blueprint $table) {
            $table->integer('id')->increment();
            $table->string('nome');
            $table->integer('tuno_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tuno_id')->references('id')->on('turnos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('celula');
    }
}
