<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Recreates the original login behaviour as real Laravel accounts.
 *
 * The original login.php accepted:
 *   - the hard-coded super-user  admin / admin123
 *   - any employee by name (the password path existed but the pegawai
 *     table had no password column, so in practice only admin worked).
 *
 * Here we provision:
 *   - one `admin` account (role: admin), password "admin123"
 *   - one login per employee (role: pegawai), username = employee name,
 *     default password "password123" — linked to the pegawai row.
 *
 * Change these passwords after the first login.
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'id_pegawai' => null,
            ]
        );

        // One login account per employee, keyed by employee name to match
        // the original "login by pegawai name" flow.
        Pegawai::all()->each(function (Pegawai $pegawai) {
            User::updateOrCreate(
                ['username' => $pegawai->nama_pegawai],
                [
                    'name' => $pegawai->nama_pegawai,
                    'username' => $pegawai->nama_pegawai,
                    'password' => Hash::make('password123'),
                    'role' => 'pegawai',
                    'id_pegawai' => $pegawai->id_pegawai,
                ]
            );
        });
    }
}
