<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nim' => '22.230.0001', 'nama' => 'Fadhli Hilman Saputra', 'prodi' => 'Sistem Informasi', 'kelas' => '7P51'],
            ['nim' => '22.230.0002', 'nama' => 'Ronaldo',  'prodi' => 'Teknik Informatika', 'kelas' => '7P41'],
            ['nim' => '22.230.0003', 'nama' => 'Shin Tae Yong',     'prodi' => 'Manajemen Informatika', 'kelas' => '7P41'],
            ['nim' => '22.230.0004', 'nama' => 'Kluivert',  'prodi' => 'Komputerisasi Akuntansi', 'kelas' => '7P31'],
        ];

        $this->db->table('mahasiswa')->insertBatch($data);
    }
}
