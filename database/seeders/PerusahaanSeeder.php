<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        Perusahaan::updateOrCreate(
            ['id_perusahaan' => 'PER01'],
            [
                'id_perusahaan' => 'PER01',
                'nama_perusahaan' => 'Nama Perusahaan',
                'alamat_perusahaan' => 'Alamat',
                'no_telpon' => 'No Telpon',
                'no_fax' => 'No Fax',
                'email_perusahaan' => 'Email@email.com',
                'nama_penandatangan' => 'Nama Penandatangan',
                'jabatan' => 'Jabatan',
                'nama_petugas' => 'Nama Petugas',
            ]
        );
    }
}
