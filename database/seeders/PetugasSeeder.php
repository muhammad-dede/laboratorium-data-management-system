<?php

namespace Database\Seeders;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin@email.com',
                'password' => Hash::make('password'),
                'image' => 'default.svg',
                'role' => 'admin',
                'aktif' => true
            ],
            [
                'email' => 'staff@email.com',
                'password' => Hash::make('password'),
                'image' => 'default.svg',
                'role' => 'staff',
                'aktif' => true
            ],
            [
                'email' => 'kepala_lab@email.com',
                'password' => Hash::make('password'),
                'image' => 'default.svg',
                'role' => 'kepala',
                'aktif' => true
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $petugas = [
            [
                'nama' => 'Administrator',
                'nip' => '0000000000',
                'telp' => '081295705672',
                'jabatan' => 'Staff',
                'id_user' => 1,
            ],
            [
                'nama' => 'Staff',
                'nip' => '111111111',
                'telp' => '081295705672',
                'jabatan' => 'Staff',
                'id_user' => 2,
            ],
            [
                'nama' => 'Kepala Laboratorium',
                'nip' => '222222222',
                'telp' => '081295705672',
                'jabatan' => 'Kepala Laboratorium',
                'id_user' => 3,
            ],
        ];

        foreach ($petugas as $row) {
            Petugas::create($row);
        }
    }
}
