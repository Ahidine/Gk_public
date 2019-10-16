<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEleveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleve', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenom');
            $table->integer('age');
            $table->string('lieu_naissance');
            $table->text('path_photo');
            $table->boolean('sex')->nullable();
            $table->string('nationalite');
            $table->string('comment');
            $table->string('numero');
            $table->text('adresse');
            $table->boolean('Est_Inscrit');
            $table->bigInteger('user_id')->nullable()->unsigned();         
            $table->bigInteger('centre_id')->unsigned();
            $table->bigInteger('responsable_commerciale_interne_id')->nullable()->unsigned();
            $table->bigInteger('responsable_commerciale_externe_id')->nullable()->unsigned();
           $table->bigInteger('groupe_id')->nullable()->unsigned(); 
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
        Schema::dropIfExists('eleve');
    }
}
