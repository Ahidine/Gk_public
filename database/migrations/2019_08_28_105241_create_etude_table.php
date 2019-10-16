<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtudeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etude', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("trimestre_id")->unsigned();
            $table->bigInteger("groupe_id")->unsigned();
            $table->bigInteger("module_id")->unsigned();
            $table->timestamps();
        });
        Schema::table('etude', function (Blueprint $table) {
            $table->foreign('module_id')->references('id')->on('module')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('groupe_id')->references('id')->on('groupe')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->foreign('trimestre_id')->references('id')->on('trimestre')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
        //empl
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etude');
        Schema::table('etude', function(Blueprint $table) {
            $table->dropForeign('trimestre_module_id_foreign');
            $table->dropForeign('transfert_groupe_id_foreign');
            $table->dropForeign('transfert_trimestre_id_foreign');
        });
    }
}
