<!-- resources/views/owner/laporan/produk.blade.php -->
@extends('layouts.owner')

@section('title', 'Laporan Produk')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-lg font-semibold">Laporan Data Produk</h3>
        
        <form action="{{ route('owner.laporan.produk') }}" method="GET" class="flex gap-4">
            <div class="flex items-center gap-3">
                <div>
                    <label class="block text-sm text-gray-600">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>
            
            <div class="flex items-end gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <button type="submit" name="export" value="1" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    <i class="fas fa-download mr-2"></i>Export PDF
                </button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama Produk</th>
                    <th class="px-4 py-2 text-left">Kategori</th>
                    <th class="px-4 py-2 text-right">Harga</th>
                    <th class="px-4 py-2 text-right">Stok</th>
                    <th class="px-4 py-2 text-left">Tanggal Ditambahkan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $key => $item)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $key + 1 }}</td>
                    <td class="px-4 py-2">{{ $item->nama }}</td>
                    <td class="px-4 py-2">{{ $item->kategori->nama_kategori }}</td>
                    <td class="px-4 py-2 text-right">Rp {{ number_format($item->harga) }}</td>
                    <td class="px-4 py-2 text-right">{{ $item->stok }}</td>
                    <td class="px-4 py-2">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr class="border-t">
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                        Tidak ada data produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection