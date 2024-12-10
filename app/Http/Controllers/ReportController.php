<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function generatePDF(Request $request)
    {
        $period = $request->period ?? 'daily';
        $date = $request->date ?? Carbon::now();
        $type = $request->type ?? 'products';

        if ($type === 'products') {
            switch($period) {
                case 'daily':
                    $produk = Produk::with('kategori')
                        ->whereDate('created_at', Carbon::parse($date))
                        ->get();
                    $title = 'Laporan Harian Produk - ' . Carbon::parse($date)->format('d M Y');
                    break;
                case 'monthly':
                    $produk = Produk::with('kategori')
                        ->whereMonth('created_at', Carbon::parse($date)->month)
                        ->whereYear('created_at', Carbon::parse($date)->year)
                        ->get();
                    $title = 'Laporan Bulanan Produk - ' . Carbon::parse($date)->format('M Y');
                    break;
                case 'yearly':
                    $produk = Produk::with('kategori')
                        ->whereYear('created_at', Carbon::parse($date)->year)
                        ->get();
                    $title = 'Laporan Tahunan Produk - ' . Carbon::parse($date)->format('Y');
                    break;
                default:
                    $produk = Produk::with('kategori')->get();
                    $title = 'Laporan Produk';
                    break;
            }

            $pdf = PDF::loadView('reports.products', [
                'produk' => $produk,
                'title' => $title,
                'period' => $period,
                'date' => $date
            ]);

            return $pdf->download("laporan_produk_{$period}_" . Carbon::parse($date)->format('Y-m-d') . '.pdf');
        } else {
            switch($period) {
                case 'daily':
                    $users = User::whereDate('created_at', Carbon::parse($date))
                        ->get();
                    $title = 'Laporan Harian Pengguna - ' . Carbon::parse($date)->format('d M Y');
                    break;
                case 'monthly':
                    $users = User::whereMonth('created_at', Carbon::parse($date)->month)
                        ->whereYear('created_at', Carbon::parse($date)->year)
                        ->get();
                    $title = 'Laporan Bulanan Pengguna - ' . Carbon::parse($date)->format('M Y');
                    break;
                case 'yearly':
                    $users = User::whereYear('created_at', Carbon::parse($date)->year)
                        ->get();
                    $title = 'Laporan Tahunan Pengguna - ' . Carbon::parse($date)->format('Y');
                    break;
            }

            $pdf = PDF::loadView('reports.users', [
                'users' => $users,
                'title' => $title,
                'period' => $period,
                'date' => $date
            ]);

            return $pdf->download("laporan_pengguna_{$period}_" . Carbon::parse($date)->format('Y-m-d') . '.pdf');
        }
    }
}