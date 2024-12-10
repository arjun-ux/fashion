<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distro Admin Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;600&display=swap');
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: #0F172A;
        }

        .logo-text {
            font-family: 'Bebas Neue', sans-serif;
        }

        .sidebar-pattern {
            background: linear-gradient(180deg, #0F172A 0%, #020617 100%);
        }

        .menu-item {
            position: relative;
            transition: all 0.3s;
        }

        .menu-item:hover {
            background: rgba(220, 38, 38, 0.1);
            border-left: 4px solid #DC2626;
        }
    </style>
</head>
<body class="min-h-screen flex bg-gray-900 text-gray-100">
    <aside id="sidebar" class="w-64 sidebar-pattern text-gray-100 transition-all duration-300 border-r border-red-500/10">
        <div class="p-6 border-b border-red-500/10">
            <h1 class="logo-text text-3xl text-red-500 tracking-wider">DISTRO</h1>
            <p class="text-xs text-gray-500 mt-1">Admin Panel</p>
        </div>
        
        <nav class="mt-8">
            <ul class="space-y-1 px-4">
                <li class="menu-item">
                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 p-4">
                        <i class="fas fa-chart-line text-red-500"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.produk.index') }}" class="flex items-center gap-3 p-4">
                        <i class="fas fa-tshirt text-red-500"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-3 p-4">
                        <i class="fas fa-tags text-red-500"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.pengguna.index') }}" class="flex items-center gap-3 p-4">
                        <i class="fas fa-users text-red-500"></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="bg-gray-900/90 border-b border-red-500/10 backdrop-blur-sm">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="text-red-500 hover:text-red-400 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="ml-4 text-xl font-bold text-gray-100 uppercase tracking-wider">{{ $title ?? 'Dashboard' }}</h2>
                </div>
                <div class="flex items-center gap-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-6 py-2 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 rounded-lg transition-all duration-300">
                            <i class="fas fa-sign-out-alt text-red-400"></i>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="flex-1 p-6 overflow-auto">
            <div class="container mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        let sidebarExpanded = true;

        sidebarToggle.addEventListener('click', () => {
            sidebarExpanded = !sidebarExpanded;
            if (sidebarExpanded) {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                document.querySelectorAll('#sidebar span').forEach(span => {
                    span.style.display = 'inline';
                });
            } else {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                document.querySelectorAll('#sidebar span').forEach(span => {
                    span.style.display = 'none';
                });
            }
        });

        const currentPath = window.location.pathname;
        document.querySelectorAll('#sidebar li').forEach(li => {
            const link = li.querySelector('a');
            if (link.getAttribute('href') === currentPath) {
                li.classList.add('border-l-4');
                li.classList.add('border-red-500');
                li.classList.add('bg-red-500/10');
            }
        });
    </script>
</body>
</html>