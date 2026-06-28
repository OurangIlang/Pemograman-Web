<?php

namespace Database\Seeders;

use App\Models\BahanBaku;
use Illuminate\Database\Seeder;

class BahanBakuSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id_bahan_baku' => 'BB01', 'nama_bahan_baku' => 'Besi', 'harga_bahan_baku' => 100.00],
            ['id_bahan_baku' => 'bb123', 'nama_bahan_baku' => 'Solar', 'harga_bahan_baku' => 150000.00],
        ];

        foreach ($rows as $row) {
            BahanBaku::updateOrCreate(['id_bahan_baku' => $row['id_bahan_baku']], $row);
        }
    }
}
