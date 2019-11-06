<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->date('date');
            $table->string('motif');
            $table->string('type');
            $table->bigInteger('employe_id')->nullable()->unsigned();
            $table->bigInteger('eleve_id')->nullable()->unsigned();
            $table->string('seance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absences');
    }
}
