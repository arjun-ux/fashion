<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    
    protected $fillable = [
        'nama_kategori'
    ];

    // Relasi ke model Produk (one-to-many)
    public function produks()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}