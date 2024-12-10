<x-app-layout>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
                        url('https://www.transparenttextures.com/patterns/black-thread-light.png');
            color: #fff;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background-color: #1a1a1a;
            background-image: url("data:image/svg+xml,%3Csvg width='6' height='6' viewBox='0 0 6 6' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%232a2a2a' fill-opacity='0.4' fill-rule='evenodd'%3E%3Cpath d='M5 0h1L0 6V5zM6 5v1H5z'/%3E%3C/g%3E%3C/svg%3E");
            color: #ffffff;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            position: fixed;
            height: 100vh;
            border-right: 1px solid rgba(184, 134, 11, 0.3);
        }

        .sidebar .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #B8860B;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .sidebar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 1.5rem;
            border: 2px solid #B8860B;
            padding: 3px;
        }

        .sidebar a, .sidebar form button {
            color: #ffffff;
            text-decoration: none;
            padding: 1rem 1.2rem;
            border-radius: 8px;
            margin-bottom: 0.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-align: left;
        }

        .sidebar a:hover, .sidebar form button:hover {
            background-color: rgba(184, 134, 11, 0.2);
            color: #B8860B;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            flex-grow: 1;
            height: 100vh;
            overflow-y: auto;
            background-color: transparent;
        }

        .header {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #B8860B;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Filter Section */
        .filter-section {
            background: rgba(26, 26, 26, 0.7);
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            gap: 1.5rem;
            align-items: center;
            margin-bottom: 2rem;
            border: 1px solid rgba(184, 134, 11, 0.3);
        }

        .filter-section label {
            color: #B8860B;
            font-weight: 500;
        }

        .filter-section input[type="date"] {
            background: #2d2d2d;
            border: 1px solid rgba(184, 134, 11, 0.3);
            color: #fff;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            outline: none;
        }

        .filter-section button {
            background: #B8860B;
            color: #fff;
            padding: 0.6rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-section button:hover {
            background: #946B08;
            box-shadow: 0 0 15px rgba(184, 134, 11, 0.4);
        }

        /* Table styling */
        .table-container {
            background: rgba(26, 26, 26, 0.7);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(184, 134, 11, 0.3);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th, td {
            padding: 1.2rem;
            border-bottom: 1px solid rgba(184, 134, 11, 0.2);
            color: #fff;
        }

        th {
            background-color: rgba(184, 134, 11, 0.2);
            color: #B8860B;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:hover {
            background-color: rgba(184, 134, 11, 0.1);
        }

        /* Report note */
        .report-note {
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            margin-top: 2rem;
            font-style: italic;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(26, 26, 26, 0.7);
            border: 1px solid rgba(184, 134, 11, 0.3);
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .stat-card .title {
            color: #B8860B;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card .value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #fff;
        }

        .stat-card .trend {
            color: #4CAF50;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
    </style>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">Distro Panel</div>
        
        <img src="/images/owner.webp" alt="Owner Profile">

        <a href="#">
            <i class="fas fa-tachometer-alt text-[#B8860B]"></i> Dashboard
        </a>
        <a href="#">
            <i class="fas fa-chart-bar text-[#B8860B]"></i> Laporan Penjualan
        </a>
        <a href="#">
            <i class="fas fa-tshirt text-[#B8860B]"></i> Katalog Produk
        </a>
        <a href="#">
            <i class="fas fa-users text-[#B8860B]"></i> Manajemen Staff
        </a>
        
        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit">
                <i class="fas fa-sign-out-alt text-[#B8860B]"></i> Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">Dashboard Overview</div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="title">Total Penjualan Bulan Ini</div>
                <div class="value">Rp 15,750,000</div>
                <div class="trend">
                    <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                </div>
            </div>
            <div class="stat-card">
                <div class="title">Produk Terjual</div>
                <div class="value">234 Items</div>
                <div class="trend">
                    <i class="fas fa-arrow-up"></i> 8% dari bulan lalu
                </div>
            </div>
            <div class="stat-card">
                <div class="title">Rata-rata Penjualan Harian</div>
                <div class="value">Rp 525,000</div>
                <div class="trend">
                    <i class="fas fa-arrow-up"></i> 5% dari bulan lalu
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <label for="start-date">Dari:</label>
            <input type="date" id="start-date" name="start-date">
            
            <label for="end-date">Sampai:</label>
            <input type="date" id="end-date" name="end-date">
            
            <button type="button"><i class="fas fa-search"></i> Tampilkan Laporan</button>
        </div>

        <!-- Report Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Total Penjualan</th>
                        <th>Produk Terjual</th>
                        <th>Kategori Terlaris</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Januari 2024</td>
                        <td>Rp 15,500,000</td>
                        <td>145 items</td>
                        <td>T-Shirt</td>
                        <td><span class="text-green-500"><i class="fas fa-arrow-up"></i> Naik</span></td>
                    </tr>
                    <tr>
                        <td>Februari 2024</td>
                        <td>Rp 17,800,000</td>
                        <td>167 items</td>
                        <td>Hoodie</td>
                        <td><span class="text-green-500"><i class="fas fa-arrow-up"></i> Naik</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="report-note">
            <p>* Data diperbarui secara real-time. Laporan lengkap dapat diunduh dalam format PDF.</p>
        </div>
    </div>
</x-app-layout>