<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $projects = [
            [
                'title' => 'Sistem Informasi Akademik',
                'description' => 'Aplikasi berbasis web untuk mengelola data
                mahasiswa, jadwal kuliah, dan nilai perkuliahan',
                'teknologi' => 'Laravel & Bootstrap',
                'image' => 'project1.jpg',
                'status' => 'selesai',
            ],
            [
                'title' => 'E-commerce SEO Optimization',
                'description' => 'Aplikasi optimalisasi struktur heading dan indexing
                halaman web toko online',
                'teknologi' => 'php & Google Search Console',
                'image' => 'project2.jpg',
                'status' => 'selesai',
            ],
            [
                'title' => 'desain UI/UX Aplikasi Mobile',
                'description' => 'Aplikasi desain UI/UX untuk aplikasi
                 mobile berbasis Android dan iOS',
                'teknologi' => 'Figma & Adobe XD',
                'image' => 'project3.jpg',
                'status' => 'selesai',
            ],
            [
                'title' => 'portal berita mahasiswa',
                'description' => 'Aplikasi portal berita berbasis web untuk mahasiswa
                di lingkungan kampus',
                'teknologi' => 'Laravel & Bootstrap',
                'image' => 'project4.jpg',
                'status' => 'selesai',
            ],
            [
                'title' => 'Aplikasi manajemen keuangan pribadi',
                'description' => 'Aplikasi berbasis web untuk mengelola keuangan pribadi, termasuk
                pengeluaran, pemasukan, dan laporan keuangan',
                'teknologi' => 'Laravel & Bootstrap',
                'image' => 'project5.jpg',
                'status' => 'selesai',
            ],
            [
                'title' => 'Desain adobe illustrator untuk poster kampus',
                'description' => 'Aplikasi desain poster kampus berbasis adobe illustrator
                 untuk keperluan promosi dan informasi',
                'teknologi' => 'Adobe Illustrator',
                'image' => 'project6.jpg',
                'status' => 'selesai',
            ],
            [
                'title' => 'manajemen proyek berbasis web',
                'description' => 'Aplikasi manajemen proyek berbasis web untuk mengelola tugas,
                 jadwal, dan kolaborasi tim',
                'teknologi' => 'Laravel & Bootstrap',
                'image' => 'project7.jpg',
                'status' => 'selesai',
            ],
            [
                'title' => 'Redesain Cover dan branding',
                'description' => 'Aplikasi desain cover dan branding berbasis adobe illustrator
                 untuk keperluan promosi dan identitas visual',
                'teknologi' => 'Adobe Illustrator',
                'image' => 'project1.jpg',
                'status' => 'selesai',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
