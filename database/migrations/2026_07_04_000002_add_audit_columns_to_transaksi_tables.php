<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds the columns needed for "Riwayat Transaksi" (transaction history):
 * which logged-in user created the header row, plus created_at/updated_at
 * so the history page can show when a transaction was recorded/changed.
 *
 * Nothing here changes existing columns, indexes, or foreign keys — it
 * only adds new, nullable columns so existing data and behaviour are
 * unaffected.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nota_pembelian', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('informasi')
                ->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('invoice_penjualan', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('tanggal')
                ->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('nota_pembelian', function (Blueprint $table) {
            $table->dropConstrainedForeignId('created_by');
            $table->dropColumn(['created_at', 'updated_at']);
        });

        Schema::table('invoice_penjualan', function (Blueprint $table) {
            $table->dropConstrainedForeignId('created_by');
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};
