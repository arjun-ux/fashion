<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farhan Distro - Inventory Management</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)),
                        url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=1974');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(51, 65, 85, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .neon-text {
            color: #0EA5E9;
            text-shadow: 0 0 10px rgba(14, 165, 233, 0.5);
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen">
        <div class="relative min-h-screen flex flex-col">
            <!-- Header -->
            <header class="fixed top-0 w-full glass-card z-50">
                <div class="max-w-7xl mx-auto px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-bold neon-text">FARHAN DISTRO STORE</h1>
                        @if (Route::has('login'))
                            <nav class="space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sky-400 hover:text-sky-300 transition-colors">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sky-400 hover:text-sky-300 transition-colors">
                                        Log in
                                    </a>
                                @endauth
                            </nav>
                        @endif
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 w-full max-w-7xl px-6 py-24 mx-auto mt-16">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Sistem Pengelolaan Stok Distro</h2>
                    <p class="text-xl text-gray-300">Mengoptimalkan Kontrol Inventaris & Distribusi</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Stock Management -->
                    <div class="glass-card rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-box text-sky-400 text-2xl mr-3"></i>
                            <h3 class="text-xl font-semibold text-white">Manajemen Stok</h3>
                        </div>
                        <p class="text-gray-300">Kontrol persediaan barang, pengaturan stok minimum, dan pemantauan status produk secara real-time.</p>
                    </div>

                    <!-- Distribution -->
                    <div class="glass-card rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-truck text-sky-400 text-2xl mr-3"></i>
                            <h3 class="text-xl font-semibold text-white">Distribusi</h3>
                        </div>
                        <p class="text-gray-300">Kelola pengiriman barang, pantau status distribusi, dan atur jadwal pengiriman ke berbagai outlet.</p>
                    </div>

                    <!-- Reports -->
                    <div class="glass-card rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-chart-bar text-sky-400 text-2xl mr-3"></i>
                            <h3 class="text-xl font-semibold text-white">Laporan</h3>
                        </div>
                        <p class="text-gray-300">Analisis performa penjualan, pemantauan stok, dan pelaporan distribusi barang secara berkala.</p>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="w-full glass-card mt-auto">
                <div class="max-w-7xl mx-auto px-6 py-4 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} FARHAN DISTRO STORE</p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>