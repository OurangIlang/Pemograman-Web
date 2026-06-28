<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::updateOrCreate(
            ['id_customer' => 'CUST01'],
            [
                'id_customer' => 'CUST01',
                'nama_customer' => 'Nama Customer',
                'nama_pt' => 'Nama PT',
                'alamat_pt' => 'Alamat PT',
            ]
        );
    }
}
