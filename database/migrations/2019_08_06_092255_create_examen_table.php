<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->date('date_examen');
            $table->string('periode');
            $table->double('note');
            $table->bigInteger('module_id')->unsigned();
            $table->bigInteger('eleve_id')->unsigned();
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
        Schema::dropIfExists('examen');
    }
}
