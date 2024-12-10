<x-app-layout>
    <!-- CSS Styling -->
    <style>
        /* General Layout */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .layout-container {
            display: flex;
            min-height: 100vh;
            width: 100vw;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        /* Semua CSS yang sudah Anda buat sebelumnya */
    </style>

    <!-- Layout Container -->
    <div class="layout-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>FARHAN FASHION STORE</h2>
                <span class="admin-badge">ADMIN</span>
            </div>
            
            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item">
                    <span class="menu-icon">📊</span>Dashboard
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">📥</span>Input
                </a>
                <div class="submenu">
                    <a href="{{ route('admin.users') }}" class="menu-item">
                        <span class="menu-icon">👥</span>Kelola Pengguna
                    </a>
                    <a href="{{ route('admin.products') }}" class="menu-item">
                        <span class="menu-icon">👕</span>Kelola Produk
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header-bar">
                BERANDA
            </div>

            <div class="card-container">
                <div class="card">
                    <div class="card-content">
                        <div class="card-number">{{ $productCount }}</div>
                        <div class="card-label">Product</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.products') }}">Selengkapnya</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="card-number">{{ $userCount }}</div>
                        <div class="card-label">User</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.users') }}">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>