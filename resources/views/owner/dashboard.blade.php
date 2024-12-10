@extends('layouts.owner')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 bg-[#0f172a]"> <!-- Dark navy background -->
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2">
            <i class="fas fa-tachometer-alt text-[#ff6b6b]"></i>
            <h1 class="text-xl font-semibold text-white">Dashboard</h1>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Produk -->
        <div class="bg-[#1e293b] rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 mb-1">Total Produk</p>
                    <h3 class="text-2xl font-bold text-white">{{ $totalProduk ?? '0' }}</h3>
                </div>
                <div class="p-3">
                    <i class="fas fa-box text-[#ff6b6b] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Penjualan -->
        <div class="bg-[#1e293b] rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 mb-1">Total Penjualan</p>
                    <h3 class="text-2xl font-bold text-white">{{ $totalPenjualan ?? '0' }}</h3>
                </div>
                <div class="p-3">
                    <i class="fas fa-shopping-cart text-[#ff6b6b] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-[#1e293b] rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 mb-1">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold text-white">Rp {{ number_format($totalPendapatan ?? 0) }}</h3>
                </div>
                <div class="p-3">
                    <i class="fas fa-money-bill text-[#ff6b6b] text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="bg-[#1e293b] rounded-lg p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Grafik Penjualan 7 Hari Terakhir</h3>
        <div class="h-[400px]"> <!-- Fixed height container -->
            <canvas id="salesChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesData = @json($dailySales ?? []);
    
    // Pastikan data tidak kosong
    if (!salesData || salesData.length === 0) {
        const noDataMsg = document.createElement('div');
        noDataMsg.className = 'text-center text-gray-400 py-8';
        noDataMsg.textContent = 'Belum ada data penjualan';
        ctx.canvas.parentNode.appendChild(noDataMsg);
        return;
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: salesData.map(item => item.date),
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: salesData.map(item => item.total_sales),
                borderColor: '#ff6b6b',
                backgroundColor: 'rgba(255, 107, 107, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#ff6b6b',
                pointBorderColor: '#1e293b',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#cbd5e1',
                        padding: 10,
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#cbd5e1',
                        padding: 10
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#cbd5e1',
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    padding: 12,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection