<?php

namespace Database\Seeders;

use App\Models\DetailInvoicePenjualan;
use Illuminate\Database\Seeder;

class DetailInvoiceSeeder extends Seeder
{
    public function run(): void
    {
        DetailInvoicePenjualan::updateOrCreate(
            ['no_invoice' => 'INV01', 'id_barang' => 'bk12'],
            [
                'qty' => 5,
                'unit_price' => 10000.00,
                'sub_total' => 50000.00,
                'total_price' => 50000.00,
                'deskripsi' => 'pipa plastik',
            ]
        );
    }
}
