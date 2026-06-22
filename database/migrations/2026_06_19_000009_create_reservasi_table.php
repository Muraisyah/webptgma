<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('reservasi')) {
            Schema::create('reservasi', function (Blueprint $table) {
                $table->increments('id_reservasi');
                $table->string('kode_reservasi',20)->unique();
                $table->unsignedInteger('id_user');
                $table->unsignedInteger('id_paket');
                $table->dateTime('tgl_reservasi')->nullable();
                $table->integer('jumlah_jemaah')->nullable();
                $table->bigInteger('total_biaya')->nullable();
                $table->enum('status_reservasi',['Menunggu Pembayaran','DP','Lunas','Dibatalkan'])->default('Menunggu Pembayaran');
                $table->enum('status_keberangkatan',['Belum Berangkat','Sudah Berangkat','Selesai'])->default('Belum Berangkat');
                $table->text('catatan')->nullable();
                $table->timestamps();

                $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('id_paket')->references('id_paket')->on('paket')->onDelete('cascade')->onUpdate('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
