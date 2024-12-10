<?php

namespace Database\Factories;
use App\Models\Kategori;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    protected $model = Produk::class;

    public function definition()
    {
        return [
            'nama' => fake()->name(),
            'harga' => fake()->randomNumber(),
            'stok' => fake()->randomNumber(),
            'kategori_id' => Kategori::factory(),
            'gambar' => "image/image1",
        ];
    }
}
