<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFournitureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fourniture', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('Est_Livre');
            $table->text('commentaire');
            $table->date('date_livraison');
            $table->bigInteger('eleve_id')->unsigned();
            $table->bigInteger('module_id')->unsigned();
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
        Schema::dropIfExists('fourniture');
    }
}
