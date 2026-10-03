<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $mahasiswas = [
            [
                'nim' => '251011700291',
                'nama' => 'Muhammad Farrel Aliby',
                'prodi' => 'Sistem Informasi',
                'kampus' => 'Universitas Pamulang',
                'email' => 'farrelaliby067@gmail.com',
            ],
        ];

        foreach ($mahasiswas as $mahasiswa) {
            Mahasiswa::create($mahasiswa);
        }
    }
}
