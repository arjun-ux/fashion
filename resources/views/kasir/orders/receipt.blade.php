<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $order->id }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
            background-color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px dashed #000;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .header p {
            margin: 5px 0;
            color: #333;
        }

        .info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .info p {
            margin: 5px 0;
            color: #333;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            padding: 12px 8px;
            border-bottom: 2px solid #ddd;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            color: #333;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px dashed #000;
            color: #333;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 2px dashed #000;
            font-size: 12px;
            color: #666;
        }

        .footer p {
            margin: 3px 0;
        }

        @media print {
            body {
                padding: 0;
                background: none;
            }
            
            .info {
                background: none;
            }
            
            th {
                background: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>FARHAN FASHION STORE</h2>
        <p>Jl Raya Kopo No 123</p>
        <p>Telp: 08123456789</p>
    </div>

    <div class="info">
        <p>No. Struk: #{{ $order->id }}</p>
        <p>Tanggal: {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
        <p>Kasir: {{ auth()->user()->name }}</p>
        <p>Pelanggan: {{ $order->customer_name }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th style="text-align: center;">Qty</th>
                <th style="text-align: right;">Harga</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->produk->nama }}</td>
                <td style="text-align: center;">{{ $order->quantity }}</td>
                <td style="text-align: right;">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                <td style="text-align: right;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        <p>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    </div>

    <div class="footer">
        <p>Terima kasih atas kunjungan Anda!</p>
        <p>Barang yang sudah dibeli tidak dapat ditukar/dikembalikan</p>
    </div>
</body>
</html>