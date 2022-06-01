<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropMaquinaIdFromProducaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producaos', function (Blueprint $table) {
            $table->dropForeign('producaos_maquina_id_foreign');
            $table->dropColumn('maquina_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producaos', function (Blueprint $table) {
            //
        });
    }
}
