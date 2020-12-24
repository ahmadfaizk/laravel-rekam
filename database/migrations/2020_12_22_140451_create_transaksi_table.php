<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_makam');
            $table->enum('status', ['Belum Dibayar', 'Menunggu Verfifikasi', 'Berhasil', 'Gagal'])->default('Belum Dibayar');
            $table->string('bukti_transfer')->nullable();
            $table->dateTime('waktu_pembayaran')->nullable();
            $table->integer('total_transaksi');
            $table->dateTime('waktu_transaksi');

            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('transaksi');
    }
}
