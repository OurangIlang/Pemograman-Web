<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds the `updated_by` audit column to the transaction header tables
 * (nota_pembelian, invoice_penjualan) to complement the `created_by`
 * column added previously. Together with `deleted_by` (added in the
 * next migration) this completes the full audit trail requested:
 * created_by / updated_by / deleted_by on every transaction table.
 *
 * Uses Schema::hasColumn() guards so this migration is safe to run
 * against a database that already has some of these columns, and never
 * touches or drops any existing table/column/data.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nota_pembelian', function (Blueprint $table) {
            if (! Schema::hasColumn('nota_pembelian', 'updated_by')) {
                $table->foreignId('updated_by')->nullable()->after('created_by')
                    ->constrained('users')->nullOnDelete();
            }
        });

        Schema::table('invoice_penjualan', function (Blueprint $table) {
            if (! Schema::hasColumn('invoice_penjualan', 'updated_by')) {
                $table->foreignId('updated_by')->nullable()->after('created_by')
                    ->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('nota_pembelian', function (Blueprint $table) {
            if (Schema::hasColumn('nota_pembelian', 'updated_by')) {
                $table->dropConstrainedForeignId('updated_by');
            }
        });

        Schema::table('invoice_penjualan', function (Blueprint $table) {
            if (Schema::hasColumn('invoice_penjualan', 'updated_by')) {
                $table->dropConstrainedForeignId('updated_by');
            }
        });
    }
};
