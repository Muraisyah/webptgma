<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('paket_hotel')) {
            Schema::create('paket_hotel', function (Blueprint $table) {
                $table->unsignedInteger('id_paket');
                $table->unsignedInteger('id_hotel');
                $table->primary(['id_paket','id_hotel']);
                // Foreign keys intentionally omitted to avoid compatibility issues on this environment.
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_hotel');
    }
};
