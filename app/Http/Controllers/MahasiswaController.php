<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    //
    public function index()
    {
        $mahasiswa = [
            'nim' => '251011700291',
            'nama' => 'Muhammad Farrel Aliby',
            'prodi' => 'Sistem Informasi',
            'kampus' => 'Universitas Pamulang',
            'email' => 'farrelaliby067@gmail.com',
            'status' => 'aktif',
         
        ];

        return view('page.profile', compact('mahasiswa'));
    }
}
