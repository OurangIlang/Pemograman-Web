<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeds the database with the original sample data from the
 * pt_ken_mandiri_teknik.sql dump, plus the authentication accounts that
 * replace the original session-based login.
 *
 * Order matters because of foreign keys: masters first, then headers,
 * then detail rows, then user accounts (which reference pegawai).
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BahanBakuSeeder::class,
            BarangSeeder::class,
            CustomerSeeder::class,
            PegawaiSeeder::class,
            PerusahaanSeeder::class,
            NotaPembelianSeeder::class,
            InvoicePenjualanSeeder::class,
            DetailPembelianSeeder::class,
            DetailInvoiceSeeder::class,
            UserSeeder::class,
        ]);
    }
}
