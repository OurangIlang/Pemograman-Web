<?php

namespace Database\Seeders;

use App\Models\DetailPembelian;
use Illuminate\Database\Seeder;

class DetailPembelianSeeder extends Seeder
{
    public function run(): void
    {
        // Composite key (kode_nota + id_bahan_baku): use updateOrCreate
        // with both key columns so re-seeding stays idempotent.
        DetailPembelian::updateOrCreate(
            ['kode_nota' => 'kd1234', 'id_bahan_baku' => 'BB01'],
            [
                'qty' => 9000,
                'harga_satuan' => 100.00,
                'sub_total' => 900000.00,
                'total_harga' => 900000.00,
                'keterangan' => 'Besi Plat 2mm – lembar',
            ]
        );
    }
}
