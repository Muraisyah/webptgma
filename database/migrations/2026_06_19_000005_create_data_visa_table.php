<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('data_visa')) {
            Schema::create('data_visa', function (Blueprint $table) {
                $table->increments('id_visa');
                $table->string('nama_visa',35);
                $table->char('nomor_visa',15)->nullable();
                $table->date('tgl_berlaku_visa')->nullable();
                $table->date('tgl_exp_visa')->nullable();
                $table->string('foto_visa',255)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('data_visa');
    }
};
