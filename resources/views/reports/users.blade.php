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
        }
        .logo {
            width: 150px;
            margin-bottom: 20px;
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
        .meta-info {
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-style: italic;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            background-color: #DAA520;
            color: white;
            display: inline-block;
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
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <div class="status-badge">
                        {{ ucfirst($user->usertype) }}
                    </div>
                </td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Total Users:</strong> {{ $users->count() }}</p>
        <p>Laporan ini digenerate secara otomatis oleh sistem</p>
    </div>
</body>
</html>