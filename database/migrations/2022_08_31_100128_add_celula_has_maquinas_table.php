<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCelulaHasMaquinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celula_has_maquina', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('celula_id');
            $table->integer('maquina_id');
            $table->timestamps();
        });

        Schema::table('celula_has_maquina', function (Blueprint $table) {
            $table->foreign('maquina_id')->references('id')->on('maquinas');
            $table->foreign('celula_id')->references('id')->on('celula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('celula_has_maquina');
    }
}
