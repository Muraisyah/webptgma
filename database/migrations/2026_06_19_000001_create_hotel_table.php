<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('hotel')) {
            Schema::create('hotel', function (Blueprint $table) {
                $table->increments('id_hotel');
                $table->string('nama_hotel',50);
                $table->string('kota',30);
                $table->string('kategori_hotel',15)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel');
    }
};
