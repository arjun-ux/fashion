<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukkasirController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return view('kasir.produk.index', compact('produk'));
    }
}