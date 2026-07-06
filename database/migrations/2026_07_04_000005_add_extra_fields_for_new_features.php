<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Purely additive migration supporting the new features:
 *
 *  - perusahaan: fuller company profile (kota, provinsi, kode_pos, PIC,
 *    NPWP, keterangan, status_aktif) + created_by/updated_by so it has
 *    the same full audit trail as the transaction tables.
 *  - bahan_baku / barang: `satuan` (unit of measure), shown alongside
 *    the auto-filled name & price when picked from the database on a
 *    transaction form.
 *
 * Every column is nullable (or has a safe default), no existing column
 * is touched, dropped, or renamed, and nothing here changes any
 * existing data. Guarded with Schema::hasColumn() so it is safe to run
 * against a database that may already have some of these columns.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perusahaan', function (Blueprint $table) {
            if (! Schema::hasColumn('perusahaan', 'kota')) {
                $table->string('kota', 100)->nullable()->after('alamat_perusahaan');
            }
            if (! Schema::hasColumn('perusahaan', 'provinsi')) {
                $table->string('provinsi', 100)->nullable()->after('kota');
            }
            if (! Schema::hasColumn('perusahaan', 'kode_pos')) {
                $table->string('kode_pos', 10)->nullable()->after('provinsi');
            }
            if (! Schema::hasColumn('perusahaan', 'pic')) {
                $table->string('pic', 100)->nullable()->after('nama_petugas');
            }
            if (! Schema::hasColumn('perusahaan', 'npwp')) {
                $table->string('npwp', 30)->nullable()->after('pic');
            }
            if (! Schema::hasColumn('perusahaan', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('npwp');
            }
            if (! Schema::hasColumn('perusahaan', 'status_aktif')) {
                $table->boolean('status_aktif')->default(true)->after('keterangan');
            }
            if (! Schema::hasColumn('perusahaan', 'created_by')) {
                $table->foreignId('created_by')->nullable()->after('status_aktif')
                    ->constrained('users')->nullOnDelete();
            }
            if (! Schema::hasColumn('perusahaan', 'updated_by')) {
                $table->foreignId('updated_by')->nullable()->after('created_by')
                    ->constrained('users')->nullOnDelete();
            }
        });

        Schema::table('bahan_baku', function (Blueprint $table) {
            if (! Schema::hasColumn('bahan_baku', 'satuan')) {
                $table->string('satuan', 20)->nullable()->default('Unit')->after('harga_bahan_baku');
            }
        });

        Schema::table('barang', function (Blueprint $table) {
            if (! Schema::hasColumn('barang', 'satuan')) {
                $table->string('satuan', 20)->nullable()->default('Unit')->after('harga_barang');
            }
        });
    }

    public function down(): void
    {
        Schema::table('perusahaan', function (Blueprint $table) {
            foreach (['created_by', 'updated_by'] as $col) {
                if (Schema::hasColumn('perusahaan', $col)) {
                    $table->dropConstrainedForeignId($col);
                }
            }
            foreach (['kota', 'provinsi', 'kode_pos', 'pic', 'npwp', 'keterangan', 'status_aktif'] as $col) {
                if (Schema::hasColumn('perusahaan', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        Schema::table('bahan_baku', function (Blueprint $table) {
            if (Schema::hasColumn('bahan_baku', 'satuan')) {
                $table->dropColumn('satuan');
            }
        });

        Schema::table('barang', function (Blueprint $table) {
            if (Schema::hasColumn('barang', 'satuan')) {
                $table->dropColumn('satuan');
            }
        });
    }
};
