<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaireProfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaire_prof', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('prixParSeance');
            $table->integer('NombreSeance');
            $table->date('date_echeance');
            $table->date('date_traitement');
            $table->bigInteger('prof_id')->unsigned();
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
        Schema::dropIfExists('salaire_prof');
    }
}
