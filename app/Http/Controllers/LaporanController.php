<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller 
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        $totalUsers = User::count(); // Tambahkan perhitungan total users

        return view('admin.laporan.index', compact('totalProduk', 'totalKategori', 'totalUsers'));
    }

    public function getStats()
    {
        $stats = [
            'total_produk' => Produk::count(),
            'total_kategori' => Kategori::count(),
            'total_users' => User::count() // Tambahkan total users ke response JSON
        ];

        return response()->json($stats);
    }
    
}