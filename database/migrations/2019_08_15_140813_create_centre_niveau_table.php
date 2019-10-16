<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentreNiveauTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centre_niveau', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('centre_id')->unsigned();
            $table->bigInteger('niveau_id')->unsigned();
            $table->double('prix');
            $table->string('devise',4);
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
        Schema::dropIfExists('centre_niveau');
    }
}
