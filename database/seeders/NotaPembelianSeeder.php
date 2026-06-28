<?php

namespace Database\Seeders;

use App\Models\NotaPembelian;
use Illuminate\Database\Seeder;

class NotaPembelianSeeder extends Seeder
{
    public function run(): void
    {
        NotaPembelian::updateOrCreate(
            ['kode_nota' => 'kd1234'],
            [
                'kode_nota' => 'kd1234',
                'id_perusahaan' => 'PER01',
                'id_pegawai' => 'PEG01',
                'tanggal' => '2026-06-19',
                'informasi' => "pembelian\r\n\r\n",
            ]
        );
    }
}
