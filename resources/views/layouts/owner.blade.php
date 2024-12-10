<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Owner Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #001529;
        }

        .sidebar {
            background: #001529;
            color: #ffffff;
        }

        .menu-item {
            transition: all 0.3s ease;
            color: #94A3B8;
        }

        .menu-item:hover {
            color: #FF6B6B;
        }

        .active-menu-item {
            color: #FF6B6B;
            background: rgba(255, 107, 107, 0.1);
        }
    </style>
</head>
<body class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="sidebar w-64 min-h-screen flex flex-col">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-[#FF6B6B] flex items-center gap-2">
                DISTRO
                <span class="text-white text-lg">Owner</span>
            </h1>
        </div>

        <nav class="mt-6 flex-1">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('owner.dashboard') }}"
                       class="menu-item flex items-center gap-3 px-6 py-3 {{ request()->routeIs('owner.dashboard') ? 'active-menu-item' : '' }}">
                        <i class="fas fa-chart-line w-5"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.laporan.produk') }}"
                       class="menu-item flex items-center gap-3 px-6 py-3 {{ request()->routeIs('owner.laporan.produk') ? 'active-menu-item' : '' }}">
                        <i class="fas fa-box w-5"></i>
                        <span>Laporan Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.laporan.penjualan') }}"
                       class="menu-item flex items-center gap-3 px-6 py-3 {{ request()->routeIs('owner.laporan.penjualan') ? 'active-menu-item' : '' }}">
                        <i class="fas fa-shopping-cart w-5"></i>
                        <span>Laporan Penjualan</span>
                    </a>
                </li>
            </ul>
        </nav>

        <footer class="p-6 text-sm text-gray-400">
            &copy; {{ now()->year }} Owner Panel
        </footer>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="header flex items-center justify-between px-6 py-4 bg-white">
            <h2 class="text-xl font-semibold">
                @yield('title', 'Dashboard')
            </h2>
            <div class="flex items-center gap-4">
                <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-gray-900 flex items-center gap-1">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6 bg-white m-4 rounded-lg">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>