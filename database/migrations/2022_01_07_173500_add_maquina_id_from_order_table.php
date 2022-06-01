<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaquinaIdFromOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordems', function (Blueprint $table) {
            $table->integer('maquina_id');

        });

        Schema::create('order_cors',function (Blueprint $table){
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('cor_id');

            $table->foreign('cor_id')
                ->references('id')
                ->on('cors')
                ->onDelete('cascade');

            $table->foreign('order_id')
                ->references('id')
                ->on('ordems')
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
        Schema::drop('maquina_cors');
    }
}
