<!-- resources/views/owner/laporan/penjualan.blade.php -->
@extends('layouts.owner')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6 flex justify-between items-center">
        <h3 class="text-lg font-semibold">Filter Laporan Penjualan</h3>
        
        <form action="{{ route('owner.laporan.penjualan') }}" method="GET" class="flex gap-4">
            <select name="period" class="rounded border-gray-300">
                <option value="all" {{ request('period') == 'all' ? 'selected' : '' }}>Semua</option>
                <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Hari Ini</option>
                <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Bulan Ini</option>
                <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>Tahun Ini</option>
                <option value="custom" {{ request('period') == 'custom' ? 'selected' : '' }}>Custom</option>
            </select>
            
            <div class="custom-date {{ request('period') == 'custom' ? '' : 'hidden' }}">
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="rounded border-gray-300">
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="rounded border-gray-300">
            </div>
            
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Filter</button>
            <button type="submit" name="export" value="1" class="px-4 py-2 bg-green-500 text-white rounded">
                <i class="fas fa-download mr-2"></i> Export PDF
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Produk</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-right">Qty</th>
                    <th class="px-4 py-2 text-right">Harga</th>
                    <th class="px-4 py-2 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2">{{ $order->produk->nama ?? "Produk Tidak ada"}}</td>
                    <td class="px-4 py-2">{{ $order->customer_name }}</td>
                    <td class="px-4 py-2 text-right">{{ $order->quantity }}</td>
                    <td class="px-4 py-2 text-right">Rp {{ number_format($order->price) }}</td>
                    <td class="px-4 py-2 text-right">Rp {{ number_format($order->total_price) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="border-t">
                    <td colspan="5" class="px-4 py-2 font-bold text-right">Total Penjualan:</td>
                    <td class="px-4 py-2 font-bold text-right">Rp {{ number_format($total) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@push('scripts')
<script>
document.querySelector('select[name="period"]').addEventListener('change', function() {
    const customDate = document.querySelector('.custom-date');
    if (this.value === 'custom') {
        customDate.classList.remove('hidden');
    } else {
        customDate.classList.add('hidden');
    }
});
</script>
@endpush
@endsection