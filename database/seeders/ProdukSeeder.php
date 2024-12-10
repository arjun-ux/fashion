<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produks = [
            [
                'nama' => 'Laptop Gaming',
                'harga' => 15000000,
                'stok' => 10,
                'kategori_id' => 1,
                'gambar' => 'image/laptop.jpg'
            ],
            [
                'nama' => 'Smartphone',
                'harga' => 5000000,
                'stok' => 15,
                'kategori_id' => 1,
                'gambar' => 'image/phone.jpg'
            ],
            // Tambahkan data lain sesuai kebutuhan
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}