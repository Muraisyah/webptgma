<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('detail_reservasi')) {
            Schema::create('detail_reservasi', function (Blueprint $table) {
                $table->increments('id_detail');
                $table->unsignedInteger('id_reservasi');
                $table->unsignedInteger('id_jemaah');
                $table->timestamps();
                $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('id_jemaah')->references('id_jemaah')->on('data_jemaah')->onDelete('cascade')->onUpdate('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_reservasi');
    }
};
