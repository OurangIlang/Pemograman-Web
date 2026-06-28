<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * detail_invoice_penjualan (sales-invoice line items).
 *
 * Preserves the original schema, including the composite primary key
 * (no_invoice + id_barang) and the original FK constraints:
 *   - FK to invoice_penjualan: ON DELETE CASCADE ON UPDATE CASCADE
 *   - FK to barang: ON UPDATE CASCADE
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_invoice_penjualan', function (Blueprint $table) {
            $table->string('no_invoice', 20);
            $table->string('id_barang', 10);
            $table->integer('qty')->default(0);
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('total_price', 15, 2)->default(0);
            $table->text('deskripsi')->nullable();

            $table->primary(['no_invoice', 'id_barang']);

            $table->index('id_barang', 'fk_detail_inv_barang');

            $table->foreign('no_invoice', 'fk_detail_inv_invoice')
                ->references('no_invoice')->on('invoice_penjualan')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_barang', 'fk_detail_inv_barang')
                ->references('id_barang')->on('barang')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_invoice_penjualan');
    }
};
