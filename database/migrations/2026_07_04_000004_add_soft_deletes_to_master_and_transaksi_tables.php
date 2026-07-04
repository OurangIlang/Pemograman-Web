<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds soft-delete support (`deleted_at` + `deleted_by`) to every model
 * that must never be hard-deleted from the database:
 *
 *   - barang, bahan_baku            (pricing masters)
 *   - customer, pegawai, perusahaan (other masters)
 *   - nota_pembelian, invoice_penjualan (transaction headers)
 *
 * This is purely additive — nullable columns on existing tables — so it
 * is safe to run against a database that already has data. Nothing is
 * dropped and no existing rows are affected (deleted_at stays NULL for
 * all of them, meaning "not deleted").
 *
 * Guarded with Schema::hasColumn()/hasTable() so the migration can be
 * re-run safely and never conflicts with a partially-applied state.
 */
return new class extends Migration
{
    /**
     * Tables that need deleted_at + deleted_by.
     */
    private array $tables = [
        'barang',
        'bahan_baku',
        'customer',
        'pegawai',
        'perusahaan',
        'nota_pembelian',
        'invoice_penjualan',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (! Schema::hasColumn($tableName, 'deleted_at')) {
                    $table->softDeletes();
                }

                if (! Schema::hasColumn($tableName, 'deleted_by')) {
                    $table->foreignId('deleted_by')->nullable()
                        ->constrained('users')->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'deleted_by')) {
                    $table->dropConstrainedForeignId('deleted_by');
                }

                if (Schema::hasColumn($tableName, 'deleted_at')) {
                    $table->dropSoftDeletes();
                }
            });
        }
    }
};
