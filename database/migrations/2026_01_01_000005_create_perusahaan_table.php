<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * perusahaan (supplier companies) — original schema preserved, including
 * the original column order (nama_penandatangan, jabatan, nama_petugas).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->string('id_perusahaan', 10)->primary();
            $table->string('nama_perusahaan', 100);
            $table->string('alamat_perusahaan', 255);
            $table->string('no_telpon', 20)->nullable();
            $table->string('no_fax', 20)->nullable();
            $table->string('email_perusahaan', 100)->nullable();
            $table->string('nama_penandatangan', 100)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('nama_petugas', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
