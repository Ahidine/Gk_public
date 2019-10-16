<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("contenu");
            $table->date("date_contenu");
            $table->bigInteger("from_user")->unsigned();
            $table->bigInteger("message_id")->unsigned();
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
        Schema::dropIfExists('contenu');
    }
}
