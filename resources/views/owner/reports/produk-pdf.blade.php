<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .meta-info {
            margin-bottom: 20px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: right;
            color: #666;
        }
        .text-right {
            text-align: right;
        }
        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .summary p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Data Produk</h1>
    </div>

    <div class="meta-info">
        @php
            setlocale(LC_TIME, 'id_ID');
            \Carbon\Carbon::setLocale('id');
        @endphp
        <p>Periode: 
            @if(request('start_date') && request('end_date'))
                {{ \Carbon\Carbon::parse(request('start_date'))->timezone('Asia/Makassar')->isoFormat('D MMMM Y') }}
                s/d
                {{ \Carbon\Carbon::parse(request('end_date'))->timezone('Asia/Makassar')->isoFormat('D MMMM Y') }}
            @else
                -
            @endif
        </p>
        <p>Tanggal Cetak: {{ now()->timezone('Asia/Makassar')->isoFormat('dddd, D MMMM Y HH:mm:ss') }} WITA</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 25%">Nama Produk</th>
                <th style="width: 20%">Kategori</th>
                <th style="width: 15%" class="text-right">Harga</th>
                <th style="width: 10%" class="text-right">Stok</th>
                <th style="width: 25%">Tanggal Ditambahkan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td class="text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="text-right">{{ $item->stok }}</td>
                <td>{{ $item->created_at->timezone('Asia/Makassar')->isoFormat('D MMMM Y HH:mm:ss') }} WITA</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center">Tidak ada data produk</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Produk:</strong> {{ $produk->count() }}</p>
        <p><strong>Total Nilai Inventori:</strong> Rp {{ number_format($produk->sum(function($item) { return $item->harga * $item->stok; }), 0, ',', '.') }}</p>
        <p><strong>Rata-rata Harga Produk:</strong> Rp {{ number_format($produk->avg('harga'), 0, ',', '.') }}</p>
    </div>

    <div class="footer">
        <p>Dicetak oleh: {{ auth()->user()->name }}</p>
        <p>Halaman 1</p>
    </div>
</body>
</html>