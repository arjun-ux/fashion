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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
                        url('https://www.freepik.com/free-photo/macro-close-up-brown-red-feather-background_4522375.htm#fromView=search&page=1&position=12&uuid=c910da0a-15eb-473a-ae06-60ede77c22c1');
            background-attachment: fixed;
        }

        .sidebar-pattern {
            background: linear-gradient(180deg, #1F2937 0%, #111827 100%);
            position: relative;
            overflow: hidden;
        }

        .sidebar-pattern::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%233F4E65' fill-opacity='0.15' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='3'/%3E%3Ccircle cx='13' cy='13' r='3'/%3E%3C/g%3E%3C/svg%3E");
        }

        .menu-item {
            position: relative;
            overflow: hidden;
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(99, 102, 241, 0.1);
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            border-color: rgba(99, 102, 241, 0.5);
            background: rgba(30, 41, 59, 0.9);
            transform: translateX(5px);
        }

        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #6366F1;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .menu-item:hover::before {
            transform: scaleY(1);
        }

        .dashboard-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .glow-effect {
            position: relative;
        }

        .glow-effect::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: -1;
            background: linear-gradient(45deg, #6366F1, #818CF8);
            filter: blur(15px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .glow-effect:hover::after {
            opacity: 0.3;
        }
    </style>
</head>
<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<!-- ... head section tetap sama ... -->

<body class="min-h-screen flex bg-gray-900 text-gray-100">
    <aside id="sidebar" class="w-64 sidebar-pattern text-gray-100 transition-all duration-300 border-r border-indigo-500/20">
        <div class="p-6 border-b border-indigo-500/20">
            <h1 class="text-2xl font-bold text-indigo-400 uppercase tracking-wider flex items-center gap-2">
                <i class="fas fa-shield-alt"></i>
                Admin Panel
            </h1>
        </div>
        
        <nav class="mt-8">
            <ul class="space-y-3 px-4">
                <li class="menu-item rounded-lg">
                    <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 p-4 rounded-lg">
                        <i class="fas fa-chart-line text-indigo-400"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item rounded-lg">
                    <a href="{{ route('admin.produk.index') }}" class="flex items-center gap-3 p-4 rounded-lg">
                        <i class="fas fa-tshirt text-indigo-400"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="menu-item rounded-lg">
                    <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-3 p-4 rounded-lg">
                        <i class="fas fa-tags text-indigo-400"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="menu-item rounded-lg">
                    <a href="{{ route('admin.pengguna.index') }}" class="flex items-center gap-3 p-4 rounded-lg">
                        <i class="fas fa-users text-indigo-400"></i>
                        <span>Users</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="bg-gray-900/80 border-b border-indigo-500/20 backdrop-blur-sm">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="text-indigo-400 hover:text-indigo-300 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="ml-4 text-xl font-bold text-indigo-400 uppercase tracking-wider">{{ $title ?? 'Dashboard' }}</h2>
                </div>
                <div class="flex items-center gap-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="glow-effect flex items-center gap-2 px-6 py-2 bg-indigo-500/20 hover:bg-indigo-500/30 border border-indigo-500/50 rounded-lg transition-all duration-300">
                            <i class="fas fa-sign-out-alt text-indigo-400"></i>
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
                li.classList.add('bg-gray-800/80');
                link.classList.add('text-indigo-400');
            }
        });
    </script>
</body>
</html>