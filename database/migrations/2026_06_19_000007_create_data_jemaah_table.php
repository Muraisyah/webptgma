<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('data_jemaah')) {
            Schema::create('data_jemaah', function (Blueprint $table) {
                $table->increments('id_jemaah');
                $table->unsignedInteger('id_user');
                $table->string('nama_jemaah',35);
                $table->string('tempat_lahir',30)->nullable();
                $table->date('tgl_lahir')->nullable();
                $table->char('nik',16)->nullable();
                $table->enum('jenis_kelamin',['Laki-laki','Perempuan'])->nullable();
                $table->text('alamat')->nullable();
                $table->string('nama_ayah',35)->nullable();
                $table->enum('status_pernikahan',['Menikah','Belum Menikah'])->nullable();
                $table->string('kewarganegaraan',30)->nullable();
                $table->string('foto_ktp',255)->nullable();
                $table->string('foto_kk',255)->nullable();
                $table->string('foto_akte',255)->nullable();
                $table->string('foto_buku_nikah',255)->nullable();
                $table->string('foto_ktp_ayah',255)->nullable();
                $table->string('foto_ktp_ibu',255)->nullable();
                $table->unsignedInteger('id_passport')->nullable();
                $table->unsignedInteger('id_visa')->nullable();
                $table->unsignedInteger('id_vaksin')->nullable();
                $table->timestamps();

                $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('id_passport')->references('id_passport')->on('data_passport')->nullOnDelete()->cascadeOnUpdate();
                $table->foreign('id_visa')->references('id_visa')->on('data_visa')->nullOnDelete()->cascadeOnUpdate();
                $table->foreign('id_vaksin')->references('id_vaksin')->on('data_vaksin')->nullOnDelete()->cascadeOnUpdate();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('data_jemaah');
    }
};
