<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoMakamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_makam', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_makam');
            $table->string('foto');
            $table->timestamps();

            $table->foreign('id_makam')->references('id')->on('makam');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_makam');
    }
}
