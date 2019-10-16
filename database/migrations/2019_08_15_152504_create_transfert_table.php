<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfert', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("eleve_id")->unsigned();
            $table->bigInteger("centre_id")->unsigned();
            $table->date('date_transfert');
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
        Schema::dropIfExists('transfert');
    }
}
