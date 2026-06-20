<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('dokumen_keberangkatan')) {
            Schema::create('dokumen_keberangkatan', function (Blueprint $table) {
                $table->increments('id_dokumen');
                $table->unsignedInteger('id_jemaah');
                $table->enum('jenis_dokumen',['Paspor','Visa','Sertifikat Vaksin','Tiket Pesawat','Program Perjalanan']);
                $table->string('file_dokumen',255)->nullable();
                $table->enum('status_dokumen',['Belum Tersedia','Tersedia'])->default('Belum Tersedia');
                $table->dateTime('tgl_upload')->nullable();
                $table->timestamps();
                $table->foreign('id_jemaah')->references('id_jemaah')->on('data_jemaah')->onDelete('cascade')->onUpdate('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_keberangkatan');
    }
};
