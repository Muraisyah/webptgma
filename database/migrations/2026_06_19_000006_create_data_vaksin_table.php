<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('data_vaksin')) {
            Schema::create('data_vaksin', function (Blueprint $table) {
                $table->increments('id_vaksin');
                $table->string('nama_vaksin',35);
                $table->string('foto_vaksin',255)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('data_vaksin');
    }
};
