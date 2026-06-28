<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * barang (goods) — original schema preserved.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('id_barang', 10)->primary();
            $table->string('nama_barang', 100);
            $table->decimal('harga_barang', 15, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
