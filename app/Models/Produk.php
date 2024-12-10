<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'kode_produk',
        'nama',
        'harga',
        'stok',
        'kategori_id',
        'gambar'
    ];

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($produk) {
            $lastProduk = static::orderBy('kode_produk', 'desc')->first();
            
            if (!$lastProduk) {
                $produk->kode_produk = 'P001';
            } else {
                $lastNumber = intval(substr($lastProduk->kode_produk, 1));
                $newNumber = $lastNumber + 1;
                $produk->kode_produk = 'P' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            }
        });

        static::deleted(function ($produk) {
            // Reorder kode_produk after deletion
            $allProducts = static::orderBy('kode_produk', 'asc')->get();
            $counter = 1;
            
            foreach ($allProducts as $prod) {
                $prod->kode_produk = 'P' . str_pad($counter, 3, '0', STR_PAD_LEFT);
                $prod->save();
                $counter++;
            }
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}