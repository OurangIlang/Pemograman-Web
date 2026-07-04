<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * detail_pembelian (purchase-note line items).
 *
 * Preserves the original schema, including the composite primary key
 * (kode_nota + id_bahan_baku) and the original FK constraints:
 *   - FK to nota_pembelian: ON DELETE CASCADE ON UPDATE CASCADE
 *   - FK to bahan_baku: ON UPDATE CASCADE
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->string('kode_nota', 20);
            $table->string('id_bahan_baku', 10);
            $table->integer('qty')->default(0);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('sub_total', 15, 2);
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->text('keterangan')->nullable();

            // Composite primary key (the original used indexes; a primary
            // key is the cleaner Laravel expression of the same intent and
            // prevents duplicate (nota, bahan_baku) pairs).
            $table->primary(['kode_nota', 'id_bahan_baku']);

            $table->index('id_bahan_baku', 'fk_detail_bahan');

            $table->foreign('kode_nota', 'fk_detail_nota')
                ->references('kode_nota')->on('nota_pembelian')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_bahan_baku', 'fk_detail_bahan')
                ->references('id_bahan_baku')->on('bahan_baku')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian');
    }
};
