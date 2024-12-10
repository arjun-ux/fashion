<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data kategori yang ada (optional)
        Kategori::query()->delete();

        $kategoris = [
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Fashion'],
            ['nama_kategori' => 'Makanan'],
            ['nama_kategori' => 'Minuman'],
            ['nama_kategori' => 'Aksesoris']
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}