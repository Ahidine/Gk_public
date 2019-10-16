<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesseurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professeur', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('nombreSeance');
            $table->timestamps(); 
            $table->integer('anciennete')->nullable(); 
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('employe_id')->unsigned();
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professeur');
    }
}
