<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ordem_producaos',function (Blueprint $table){
            $table->integer('id')->increment();
            $table->integer('producao_id');
            $table->integer('ordem_id');


        });

        Schema::create('ordems', function (Blueprint $table) {
            $table->integer('id')->increment();
            $table->date('data_ini');
            $table->date('data_end');
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
        Schema::drop('ordems');
        Schema::drop('ordem_producaos');
    }
}
