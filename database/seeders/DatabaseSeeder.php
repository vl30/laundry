<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use App\Models\KategoriLayanan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Pengguna::truncate();
        KategoriLayanan::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        if (!Pengguna::where('email', 'admin@vultter.com')->exists()) {
            Pengguna::create([
                'nama' => 'Naufal Dzakwan (VL)',
                'email' => 'admin@vultter.com',
                'password' => Hash::make('password123'),
                'tipe_pengguna' => 'admin',
                'no_telepon' => '081234567890',
                'alamat' => 'Natar, Lampung',
            ]);
        }

        if (!Pengguna::where('email', 'kasir@vultter.com')->exists()) {
            Pengguna::create([
                'nama' => 'Kasir Vultter',
                'email' => 'kasir@vultter.com',
                'password' => Hash::make('password123'),
                'tipe_pengguna' => 'kasir',
                'no_telepon' => '081234567891',
                'alamat' => 'Natar, Lampung',
            ]);
        }

        $kategoriLayanan = [
            [
                'nama_kategori' => 'Cuci Kering',
                'deskripsi' => 'Layanan cuci dan pengeringan pakaian',
                'harga_per_kg' => 5000,
                'estimasi_hari' => 2,
            ],
            [
                'nama_kategori' => 'Cuci Setrika',
                'deskripsi' => 'Layanan cuci, pengeringan, dan setrika pakaian',
                'harga_per_kg' => 7000,
                'estimasi_hari' => 3,
            ],
            [
                'nama_kategori' => 'Setrika Saja',
                'deskripsi' => 'Layanan setrika pakaian yang sudah bersih',
                'harga_per_kg' => 3000,
                'estimasi_hari' => 1,
            ]
        ];

        foreach ($kategoriLayanan as $layanan) {
            if (!KategoriLayanan::where('nama_kategori', $layanan['nama_kategori'])->exists()) {
                KategoriLayanan::create($layanan);
            }
        }
    }
}
