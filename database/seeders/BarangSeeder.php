<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['id_barang' => 'ba123', 'nama_barang' => 'Kabel', 'harga_barang' => 73000.00],
            ['id_barang' => 'BAR01', 'nama_barang' => 'Panel', 'harga_barang' => 1000.00],
            ['id_barang' => 'bk12', 'nama_barang' => 'Pipa', 'harga_barang' => 10000.00],
        ];

        foreach ($rows as $row) {
            Barang::updateOrCreate(['id_barang' => $row['id_barang']], $row);
        }
    }
}
