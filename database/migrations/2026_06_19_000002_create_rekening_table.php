<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('rekening')) {
            Schema::create('rekening', function (Blueprint $table) {
                $table->increments('id_rekening');
                $table->string('nama_bank',20);
                $table->string('nomor_rekening',30);
                $table->string('atas_nama',50);
                $table->enum('status',['Aktif','Nonaktif'])->default('Aktif');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('rekening');
    }
};
