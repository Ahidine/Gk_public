<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaiementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('montant');
            $table->string('devise');
            $table->date('date_reg');
            $table->string('mode_paiement');
            $table->string('modalite');
            $table->boolean('etat');
            $table->bigInteger('eleve_id')->unsigned();
            $table->bigInteger('niveau_id')->unsigned();
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
        Schema::dropIfExists('paiement');
    }
}
