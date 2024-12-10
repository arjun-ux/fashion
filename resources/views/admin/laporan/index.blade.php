@extends('components.admin-app')

@section('content')
<div class="min-h-screen w-full relative">
    <!-- Animated background with overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-black z-0 animate-gradient"></div>
    <div class="absolute inset-0 bg-[url('https://images.pexels.com/photos/29625971/pexels-photo-29625971.jpeg')] bg-center bg-cover opacity-10"></div>

    <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8 py-12">
        <!-- Enhanced header with animated border -->
        <div class="text-center mb-12 relative">
            <div class="animate-pulse-slow">
                <h2 class="text-4xl font-bold text-red-500 uppercase tracking-wider" style="text-shadow: 0 0 15px rgba(239, 68, 68, 0.5)">
                    FARHAN FASHION STORE
                </h2>
                <div class="w-32 h-1 bg-gradient-to-r from-transparent via-red-500 to-transparent mx-auto mt-4"></div>
            </div>
            <p class="text-gray-400 mt-2 text-lg">Admin Dashboard Overview</p>
        </div>

        <div class="backdrop-blur-xl bg-gray-900/60 overflow-hidden shadow-2xl rounded-2xl border border-red-500/20">
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Enhanced Stats Cards -->
                    <div class="group">
                        <div class="bg-gradient-to-br from-red-500 via-red-600 to-red-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-400/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="flex items-center relative z-10">
                                <div class="p-4 rounded-2xl bg-black/40 shadow-2xl group-hover:shadow-red-500/20 transition-all duration-500">
                                    <svg class="h-10 w-10 text-white transform group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 10a4 4 0 01-8 0"/>
                                    </svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-xl font-medium text-white/90 uppercase tracking-wider group-hover:text-white transition-colors duration-300">Total Products</p>
                                    <p class="text-5xl font-bold text-white mt-2 group-hover:text-white transition-colors duration-300" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3)" id="totalProduk">
                                        {{ $totalProduk }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <div class="bg-gradient-to-br from-red-500 via-red-600 to-red-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-400/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="flex items-center relative z-10">
                                <div class="p-4 rounded-2xl bg-black/40 shadow-2xl group-hover:shadow-red-500/20 transition-all duration-500">
                                    <svg class="h-10 w-10 text-white transform group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7c0-2-1-3-3-3H7C5 4 4 5 4 7z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h8"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8"/>
                                    </svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-xl font-medium text-white/90 uppercase tracking-wider group-hover:text-white transition-colors duration-300">Total Categories</p>
                                    <p class="text-5xl font-bold text-white mt-2 group-hover:text-white transition-colors duration-300" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3)" id="totalKategori">
                                        {{ $totalKategori }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <div class="bg-gradient-to-br from-red-500 via-red-600 to-red-700 rounded-2xl shadow-2xl p-6 transform hover:scale-105 transition-all duration-500 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-400/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="flex items-center relative z-10">
                                <div class="p-4 rounded-2xl bg-black/40 shadow-2xl group-hover:shadow-red-500/20 transition-all duration-500">
                                    <svg class="h-10 w-10 text-white transform group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-xl font-medium text-white/90 uppercase tracking-wider group-hover:text-white transition-colors duration-300">Total Users</p>
                                    <p class="text-5xl font-bold text-white mt-2 group-hover:text-white transition-colors duration-300" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3)" id="totalUsers">
                                        {{ $totalUsers }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex justify-center">
                    <div class="w-48 h-1 bg-gradient-to-r from-transparent via-red-500 to-transparent opacity-50"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.animate-gradient {
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
}

.animate-pulse-slow {
    animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .8;
    }
}
</style>

<script>
    function updateStats() {
        fetch('/admin/laporan/stats')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalProduk').textContent = data.total_produk;
                document.getElementById('totalKategori').textContent = data.total_kategori;
                document.getElementById('totalUsers').textContent = data.total_users;
            })
            .catch(error => console.error('Error:', error));
    }

    setInterval(updateStats, 30000);
</script>
@endsection