<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsAnnexeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits_annexe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_produits');
            $table->double('montant');
            $table->bigInteger('centre_id')->unsigned();
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

        Schema::dropIfExists('produits_annexe');
    }
}
