<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('transaksi')) {
            Schema::create('transaksi', function (Blueprint $table) {
                $table->increments('id_transaksi');
                $table->unsignedInteger('id_reservasi');
                $table->string('kode_transaksi',20)->nullable();
                $table->dateTime('tgl_transaksi')->nullable();
                $table->enum('jenis_pembayaran',['DP','Pelunasan'])->nullable();
                $table->unsignedInteger('id_rekening');
                $table->bigInteger('nominal_bayar')->nullable();
                $table->string('bukti_transfer',255)->nullable();
                $table->enum('status_verifikasi',['Menunggu Verifikasi','Diterima','Ditolak'])->default('Menunggu Verifikasi');
                $table->dateTime('tgl_verifikasi')->nullable();
                $table->unsignedInteger('id_admin')->nullable();
                $table->text('keterangan')->nullable();
                $table->timestamps();

                $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('id_rekening')->references('id_rekening')->on('rekening')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('id_admin')->references('id_user')->on('user')->nullOnDelete()->cascadeOnUpdate();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
