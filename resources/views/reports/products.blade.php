<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #DAA520;
            padding-bottom: 10px;
        }
        .meta-info {
            margin-bottom: 20px;
            background-color: #f8f8f8;
            padding: 10px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #DAA520;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-style: italic;
            border-top: 2px solid #DAA520;
            padding-top: 10px;
        }
        .summary-box {
            background-color: #f8f8f8;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="meta-info">
        <p><strong>Tanggal Cetak:</strong> {{ now()->format('d/m/Y H:i:s') }}</p>
        <p><strong>Dicetak Oleh:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Periode:</strong> 
            @if($period == 'daily')
                {{ Carbon\Carbon::parse($date)->format('d M Y') }}
            @elseif($period == 'monthly')
                {{ Carbon\Carbon::parse($date)->format('M Y') }}
            @else
                {{ Carbon\Carbon::parse($date)->format('Y') }}
            @endif
        </p>
    </div>

    <div class="summary-box">
        <h3>Ringkasan</h3>
        <p><strong>Total Produk:</strong> {{ $produk->count() }} item</p>
        <p><strong>Total Stok:</strong> {{ $produk->sum('stok') }} unit</p>
        <p><strong>Total Nilai Inventori:</strong> Rp {{ number_format($produk->sum(function($item) { 
            return $item->harga * $item->stok;
        }), 0, ',', '.') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->kode_produk }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->stok }}</td>
                <td>Rp {{ number_format($item->harga * $item->stok, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Total Produk:</strong> {{ $produk->count() }} item</p>
        <p>Laporan ini digenerate secara otomatis oleh sistem</p>
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>