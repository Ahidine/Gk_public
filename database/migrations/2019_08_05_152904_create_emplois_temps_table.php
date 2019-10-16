<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploisTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplois_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->timestamps();
            $table->bigInteger('jour_id')->unsigned();
            $table->bigInteger('groupe_id')->unsigned();
            $table->bigInteger('trimestre_id')->unsigned();
            $table->bigInteger('prof_id')->unsigned();
            $table->bigInteger('salle_id')->unsigned();
            $table->bigInteger('centre_id')->unsigned();
            $table->bigInteger('module_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emplois_temps');
    }
}
