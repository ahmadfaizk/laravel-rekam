<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketTambahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_tambahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_makam');
            $table->string('nama');
            $table->integer('harga');
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
        Schema::dropIfExists('paket_tambahan');
    }
}
