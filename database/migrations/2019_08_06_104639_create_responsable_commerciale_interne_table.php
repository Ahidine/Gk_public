<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsableCommercialeInterneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable_commerciale_interne', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('employe_id')->unsigned();
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
        Schema::dropIfExists('responsable_commerciale_interne');
    }
}
