<x-app-layout>
    <!-- Custom CSS Styling for Kasir Dashboard -->
    <style>
        /* General styling reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f4f4f9;
            color: #333;
            height: 100vh;
        }

        /* Sidebar styling */
        .sidebar {
            width: 220px;
            background-color: #2d3436;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            padding: 1rem;
            position: fixed;
            height: 100%;
            text-align: center;
        }

        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #f39c12;
            margin-bottom: 2rem;
        }

        .sidebar img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        .sidebar a, .sidebar form button {
            color: #ffffff;
            text-decoration: none;
            padding: 0.8rem 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 0.5rem;
            background: none;
            border: none;
            cursor: pointer;
        }

        .sidebar a:hover, .sidebar form button:hover {
            background-color: #636e72;
        }

        /* Icon styling in sidebar */
        .sidebar i {
            font-size: 1.2rem;
            color: #f39c12;
        }

        /* Main content styling */
        .main-content {
            margin-left: 240px;
            padding: 2rem;
            width: calc(100% - 240px);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        /* Section styling */
        .section {
            width: 100%;
            padding: 1rem;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 1.5rem;
        }

        /* Section title */
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #2d3436;
        }

        /* Additional content */
        .content-info {
            text-align: center;
            color: #666;
            font-size: 1rem;
        }
    </style>

    <!-- Dashboard Layout -->
    <div class="sidebar">
        <div class="logo">Dashboard Kasir</div>
        
        <!-- Profile Image -->
        <img src="/images/kasir.jpg" alt="Kasir Profile">

        <!-- Sidebar Links with Icons -->
        <a href="#">
            <i class="fas fa-shopping-cart"></i> Transaksi Penjualan
        </a>
        <a href="#">
            <i class="fas fa-history"></i> Riwayat Transaksi
        </a>
        
        <!-- Logout Button as Form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <div class="main-content">
        <div class="header">Selamat Datang, Kasir!</div>

        <!-- Section for New Transactions -->
        <div class="section">
            <div class="section-title">Transaksi Baru</div>
            <p>Mulai catat transaksi baru dengan memilih produk dan memasukkan jumlah pembelian. Pastikan semua data yang dimasukkan sesuai dengan pesanan pelanggan.</p>
        </div>

        <!-- Section for Transaction History -->
        <div class="section">
            <div class="section-title">Riwayat Transaksi</div>
            <p>Lihat riwayat transaksi yang pernah dilakukan untuk memastikan data penjualan tercatat dengan baik. Anda dapat mencari transaksi tertentu berdasarkan tanggal atau nomor transaksi.</p>
        </div>

        <!-- Additional Content Info -->
        <div class="content-info">
            <p>Gunakan fitur "Transaksi Penjualan" untuk mencatat penjualan dan "Riwayat Transaksi" untuk memeriksa data transaksi yang telah tercatat.</p>
        </div>
    </div>

    <!-- Font Awesome for icons (Ensure Font Awesome is included in your project) -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</x-app-layout>
