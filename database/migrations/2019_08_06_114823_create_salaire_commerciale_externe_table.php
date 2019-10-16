<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaireCommercialeExterneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaire_commerciale_externe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('commission');
            $table->double('nombre_eleves');
            $table->date('date_echeance');
            $table->date('date_traitement');
            $table->bigInteger('responsable_externe_id')->unsigned();
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
        Schema::dropIfExists('salaire_commerciale_externe');
    }
}
