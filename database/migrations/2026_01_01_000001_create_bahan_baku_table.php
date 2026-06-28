<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * bahan_baku (raw materials) — preserves the original schema exactly:
 * string PK, no auto-increment, no timestamps.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->string('id_bahan_baku', 10)->primary();
            $table->string('nama_bahan_baku', 100);
            $table->decimal('harga_bahan_baku', 15, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bahan_baku');
    }
};
