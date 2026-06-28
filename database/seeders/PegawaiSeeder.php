<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        Pegawai::updateOrCreate(
            ['id_pegawai' => 'PEG01'],
            ['id_pegawai' => 'PEG01', 'nama_pegawai' => 'Nama Pegawai']
        );
    }
}
