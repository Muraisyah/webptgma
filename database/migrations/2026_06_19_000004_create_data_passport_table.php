<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('data_passport')) {
            Schema::create('data_passport', function (Blueprint $table) {
                $table->increments('id_passport');
                $table->string('nama_passport',35);
                $table->string('nama_tambahan',35)->nullable();
                $table->char('nomor_passport',9);
                $table->string('tempat_lahir_pass',30)->nullable();
                $table->date('tgl_lahir_pass')->nullable();
                $table->string('tempat_pembuatan',30)->nullable();
                $table->date('tgl_pembuatan')->nullable();
                $table->date('exp_passport')->nullable();
                $table->string('foto_identitas_pass',255)->nullable();
                $table->string('foto_nama_tambahan',255)->nullable();
                $table->enum('status_passport',['Aktif','Expired'])->default('Aktif');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('data_passport');
    }
};
