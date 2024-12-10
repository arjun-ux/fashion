
<!-- resources/views/owner/reports/penjualan-pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .header { margin-bottom: 30px; }
        .total { margin-top: 20px; text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penjualan</h1>
        <p>Periode: {{ ucfirst($period) }}</p>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Customer</th>
                <th style="text-align: right">Qty</th>
                <th style="text-align: right">Harga</th>
                <th style="text-align: right">Total</th>
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
    </table>

    <div class="total">
        <p>Total Penjualan: Rp {{ number_format($total) }}</p>
    </div>
</body>
</html>