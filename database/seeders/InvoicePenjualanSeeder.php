<?php

namespace Database\Seeders;

use App\Models\InvoicePenjualan;
use Illuminate\Database\Seeder;

class InvoicePenjualanSeeder extends Seeder
{
    public function run(): void
    {
        InvoicePenjualan::updateOrCreate(
            ['no_invoice' => 'INV01'],
            [
                'no_invoice' => 'INV01',
                'no_faktur' => 'F11',
                'no_preorder' => 'P1',
                'id_pegawai' => 'PEG01',
                'id_customer' => 'CUST01',
                'tanggal' => '2026-06-19',
            ]
        );
    }
}
