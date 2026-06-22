<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('galeri')) {
            Schema::create('galeri', function (Blueprint $table) {
                $table->increments('id_galeri');
                $table->string('judul_foto',100)->nullable();
                $table->text('deskripsi_foto')->nullable();
                $table->string('foto_jemaah',255)->nullable();
                $table->unsignedInteger('id_user');
                $table->timestamps();
                $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade')->onUpdate('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
