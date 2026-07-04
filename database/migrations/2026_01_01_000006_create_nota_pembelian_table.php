<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * nota_pembelian (purchase note headers).
 *
 * Preserves the original schema and adds the same FK constraints the
 * original SQL dump declared (ON UPDATE CASCADE to perusahaan & pegawai).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nota_pembelian', function (Blueprint $table) {
            $table->string('kode_nota', 20)->primary();
            $table->string('id_perusahaan', 10);
            $table->string('id_pegawai', 10);
            $table->date('tanggal');
            $table->text('informasi')->nullable();

            $table->index('id_perusahaan', 'fk_nota_perusahaan');
            $table->index('id_pegawai', 'fk_nota_pegawai');

            $table->foreign('id_perusahaan', 'fk_nota_perusahaan')
                ->references('id_perusahaan')->on('perusahaan')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('id_pegawai', 'fk_nota_pegawai')
                ->references('id_pegawai')->on('pegawai')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nota_pembelian');
    }
};
