<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMontagemTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('montagem', function (Blueprint $table) {
            $table->integer('id');
            $table->date('data_envio');
            $table->date('data_retorno');
            $table->integer('status_montagem_id');
            $table->integer('montadora_id');
            $table->timestamps();
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
        Schema::drop('montagem');
    }
}
