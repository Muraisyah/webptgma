<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('paket')) {
            Schema::create('paket', function (Blueprint $table) {
                $table->increments('id_paket');
                $table->string('nama_paket',50);
                $table->integer('durasi_perjalanan')->nullable();
                $table->date('tgl_keberangkatan')->nullable();
                $table->date('tgl_kepulangan')->nullable();
                $table->integer('kuota_paket')->nullable();
                $table->integer('seat_tersedia')->nullable();
                $table->bigInteger('harga_paket')->nullable();
                $table->string('maskapai',30)->nullable();
                $table->unsignedInteger('id_hotel')->nullable();
                $table->text('deskripsi')->nullable();
                $table->string('foto_paket',255)->nullable();
                $table->enum('status_paket',['Aktif','Nonaktif'])->default('Nonaktif');
                $table->timestamps();
                $table->foreign('id_hotel')->references('id_hotel')->on('hotel')->nullOnDelete()->cascadeOnUpdate();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
