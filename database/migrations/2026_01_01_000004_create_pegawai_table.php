<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * pegawai (employees) — original schema preserved.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('id_pegawai', 10)->primary();
            $table->string('nama_pegawai', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
