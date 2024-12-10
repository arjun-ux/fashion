<x-app-layout>
    <!-- CSS Styling -->
    <style>
        /* General Layout */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Flex container for sidebar and main content */
        .layout-container {
            display: flex;
            min-height: 100vh;
            width: 100vw;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: #2c2c2c;
            color: #ffffff;
            height: 100vh;
            flex-shrink: 0;
        }

        .sidebar-header {
            background-color: #2c2c2c;
            padding: 20px;
            border-bottom: 1px solid #3b3b3b;
        }

        .sidebar-header h2 {
            color: white;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .admin-badge {
            background-color: #B8860B;
            color: white;
            padding: 5px 15px;
            border-radius: 4px;
            display: inline-block;
            font-weight: bold;
        }

        .sidebar-menu {
            padding: 20px;
        }

        .menu-item {
            color: #ffffff;
            display: block;
            padding: 10px;
            text-decoration: none;
            font-weight: normal;
            margin-bottom: 5px;
            border-radius: 4px;
        }

        .menu-item:hover {
            background-color: #3b3b3b;
        }

        .submenu {
            padding-left: 20px;
        }

        /* Main Content Area */
        .main-content {
            flex-grow: 1;
            background-color: #f5f5f5;
        }

        /* Header Bar */
        .header-bar {
            background-color: #000000;
            color: white;
            padding: 15px 20px;
            font-size: 16px;
            font-weight: bold;
        }

        /* Card Container */
        .card-container {
            display: flex;
            gap: 30px;
            padding: 20px;
        }

        .card {
            background-color: #B8860B;
            border-radius: 8px;
            width: 250px;
            overflow: hidden;
        }

        .card-content {
            padding: 20px;
            color: white;
        }

        .card-number {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-label {
            font-size: 16px;
        }

        .card-footer {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-footer a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .card-footer a::after {
            content: "→";
            margin-left: 5px;
        }

        /* Icons */
        .menu-icon {
            margin-right: 10px;
            width: 20px;
            display: inline-block;
        }
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
                <a href="#" class="menu-item">
                    <span class="menu-icon">📊</span>Dashboard
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">📥</span>Input
                </a>
                <div class="submenu">
                    <a href="#" class="menu-item">
                        <span class="menu-icon">👥</span>Kelola Pengguna
                    </a>
                    <a href="#" class="menu-item">
                        <span class="menu-icon">👕</span>Kelola Produk
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header Bar -->
            <div class="header-bar">
                BERANDA
            </div>

            <!-- Cards Section -->
            <div class="card-container">
                <!-- Products Card -->
                <div class="card">
                    <div class="card-content">
                        <div class="card-number">20</div>
                        <div class="card-label">Product</div>
                    </div>
                    <div class="card-footer">
                        <a href="#">Selengkapnya</a>
                    </div>
                </div>

                <!-- Users Card -->
                <div class="card">
                    <div class="card-content">
                        <div class="card-number">3</div>
                        <div class="card-label">User</div>
                    </div>
                    <div class="card-footer">
                        <a href="#">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>