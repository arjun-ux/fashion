<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    public function index()
    {
        // Get statistics for dashboard
        $totalProduk = Produk::count();
        $totalPenjualan = Order::count();
        $totalPendapatan = Order::sum('total_price');
        
        // Get daily sales for chart
        $dailySales = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('SUM(total_price) as total_sales')
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date', 'DESC')
        ->limit(7)
        ->get();

        return view('owner.dashboard', compact(
            'totalProduk',
            'totalPenjualan', 
            'totalPendapatan',
            'dailySales'
        ));
    }

    public function laporanProduk(Request $request)
    {
        $query = Produk::with('kategori');
        
        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('created_at', [
                $request->start_date,
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        $produk = $query->get();

        if ($request->has('export')) {
            $pdf = PDF::loadView('owner.reports.produk-pdf', compact('produk'));
            return $pdf->download('laporan-produk.pdf');
        }

        return view('owner.laporan.produk', compact('produk'));
    }

    public function laporanPenjualan(Request $request)
    {
        $query = Order::with('produk');
        $period = $request->period ?? 'all';
        
        switch ($period) {
            case 'daily':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'monthly':
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                break;
            case 'yearly':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
            case 'custom':
                if ($request->filled(['start_date', 'end_date'])) {
                    $query->whereBetween('created_at', [
                        $request->start_date,
                        Carbon::parse($request->end_date)->endOfDay()
                    ]);
                }
                break;
        }

        $orders = $query->get();
        $total = $orders->sum('total_price');

        if ($request->has('export')) {
            $pdf = PDF::loadView('owner.reports.penjualan-pdf', compact('orders', 'total', 'period'));
            return $pdf->download('laporan-penjualan.pdf');
        }

        return view('owner.laporan.penjualan', compact('orders', 'total', 'period'));
    }
}