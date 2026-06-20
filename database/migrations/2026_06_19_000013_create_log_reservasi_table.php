<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('log_reservasi')) {
            Schema::create('log_reservasi', function (Blueprint $table) {
                $table->increments('id_log');
                $table->unsignedInteger('id_reservasi');
                $table->string('status_lama',30)->nullable();
                $table->string('status_baru',30)->nullable();
                $table->unsignedInteger('id_admin')->nullable();
                $table->dateTime('waktu_update')->useCurrent();
                $table->timestamps();
                $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('id_admin')->references('id_user')->on('user')->nullOnDelete()->cascadeOnUpdate();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('log_reservasi');
    }
};
