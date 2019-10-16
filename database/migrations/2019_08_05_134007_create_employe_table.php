<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->boolean('sex');
            $table->double('salaire');
            $table->string('devise');
            $table->string('email');
            $table->string('Type');
            $table->date('date_affectation');
            $table->string('Tel_mobile');
            $table->string('Tel_fixe');
            $table->text('adresse');
            $table->string('fonction');
            $table->string('path_contrat');
            $table->string('path_Cv');
            $table->string('path_diplomes');
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

        Schema::dropIfExists('employe');
    }
}
