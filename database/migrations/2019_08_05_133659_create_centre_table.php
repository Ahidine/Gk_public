<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centre', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('adresse');
            $table->boolean('type');
            $table->bigInteger('ville_id')->unsigned();
            $table->bigInteger('responsable_id')->unsigned();
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
 
        Schema::dropIfExists('centre');
    }
}
