<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiplomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplome', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule');
            $table->string('ecole');
            $table->string('specialite');
            $table->date('date_obtention');
            $table->timestamps();
            $table->bigInteger('prof_id')->unsigned();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diplome');
    }
}
