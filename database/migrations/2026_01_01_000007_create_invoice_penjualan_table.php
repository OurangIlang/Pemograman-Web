<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * invoice_penjualan (sales invoice headers).
 *
 * Preserves the original schema and FK constraints (ON UPDATE CASCADE to
 * pegawai & customer).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_penjualan', function (Blueprint $table) {
            $table->string('no_invoice', 20)->primary();
            $table->string('no_faktur', 20)->nullable();
            $table->string('no_preorder', 20)->nullable();
            $table->string('id_pegawai', 10);
            $table->string('id_customer', 10);
            $table->date('tanggal');

            $table->index('id_pegawai', 'fk_invoice_pegawai');
            $table->index('id_customer', 'fk_invoice_customer');

            $table->foreign('id_pegawai', 'fk_invoice_pegawai')
                ->references('id_pegawai')->on('pegawai')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('id_customer', 'fk_invoice_customer')
                ->references('id_customer')->on('customer')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_penjualan');
    }
};
