<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: #0F172A;
        }

        .sidebar-pattern {
            background: linear-gradient(rgba(15, 23, 42, 0.95), rgba(15, 23, 42, 0.95)),
                       
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            overflow: hidden;
        }

        .menu-item {
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(239, 68, 68, 0.1);
            transition: all 0.3s ease;
            backdrop-filter: blur(8px);
        }

        .menu-item:hover {
            border-color: rgba(239, 68, 68, 0.5);
            background: rgba(30, 41, 59, 0.6);
            transform: translateX(5px);
        }

        .menu-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #EF4444, #DC2626);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .menu-item:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .neon-glow {
            text-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
        }

        .btn-glow {
            position: relative;
            overflow: hidden;
            background: linear-gradient(45deg, #EF4444, #DC2626);
            border: none;
            z-index: 1;
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
            z-index: -1;
        }

        .btn-glow:hover::before {
            left: 100%;
        }

        .header-title {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(8px);
        }

        /* Enhanced animations */
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .animate-pulse-slow {
            animation: pulse 3s infinite;
        }

        .menu-item:hover i {
            animation: pulse 1s infinite;
        }
    </style>
</head>
<body class="min-h-screen flex bg-gray-900 text-gray-100">
    <aside id="sidebar" class="w-64 sidebar-pattern text-gray-100 transition-all duration-300 border-r border-red-500/20">
        <div class="p-6 border-b border-red-500/20 header-title">
            <h1 class="text-2xl font-bold text-red-500 uppercase tracking-wider flex items-center gap-2 animate-pulse-slow">
                <i class="fas fa-cash-register"></i>
                Kasir Panel
            </h1>
        </div>
        
        <nav class="mt-8">
            <ul class="space-y-3 px-4">
                <li class="menu-item rounded-lg relative overflow-hidden">
                    <a href="{{ route('kasir.index') }}" class="flex items-center gap-3 p-4 rounded-lg">
                        <i class="fas fa-cash-register text-red-400"></i>
                        <span>Transaksi Penjualan</span>
                    </a>
                </li>
                <li class="menu-item rounded-lg relative overflow-hidden">
                    <a href="{{ route('produk.index') }}" class="flex items-center gap-3 p-4 rounded-lg">
                        <i class="fas fa-box text-red-400"></i>
                        <span>Daftar Produk</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col">
        <header class="bg-gray-900 border-b border-red-500/20">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center">
                    <button id="sidebarToggle" class="text-red-400 hover:text-red-300 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="ml-4 text-xl font-bold text-red-400 uppercase tracking-wider neon-glow">{{ $title ?? 'Kasir' }}</h2>
                </div>
                <div class="flex items-center gap-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-glow flex items-center gap-2 px-6 py-2 text-white rounded-lg transition-all duration-300 shadow-lg hover:shadow-red-500/20">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="flex-1 p-6 overflow-auto bg-gradient-to-br from-gray-900 to-gray-800">
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
                link.classList.add('text-red-400');
            }
        });
    </script>
</body>
</html>