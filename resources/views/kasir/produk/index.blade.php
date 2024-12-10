<!-- kasir/produk/index.blade.php -->
@extends('components.kasir-app')

@section('content')
<div class="min-h-screen">
    <div class="container mx-auto px-4 py-8">
    <div class="bg-zinc-900/80 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-pink-500/20">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center text-orange-400">
                <i class="fas fa-box w-6 h-6 mr-2"></i>

                    <h1 class="text-xl font-semibold text-orange-400 neon-glow">DAFTAR PRODUK</h1>

                </div>
            </div>

            <div class="bg-zinc-800/50 rounded-lg shadow-md">
                <div class="p-4">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center text-gray-300">
                            <span>Show</span>
                            <select class="mx-2 bg-zinc-900 border border-pink-500/20 rounded px-2 py-1 focus:border-pink-500/50 transition-colors" id="showEntries">
                                @foreach([10, 25, 50] as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <span>entries</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2 text-gray-300">Search:</span>
                            <input type="text" id="searchInput" 
                                   class="bg-zinc-900 border border-pink-500/20 rounded px-2 py-1 text-gray-300 focus:border-pink-500/50 transition-colors" 
                                   placeholder="Search...">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-pink-500/20">
                            <thead>
                                <tr class="bg-zinc-800/80">
                                <th class="border border-pink-500/20 px-4 py-2 text-left text-gray-300">No</th>
                                    <th class="border border-pink-500/20 px-4 py-2 text-left text-gray-300">Nama</th>
                                    <th class="border border-pink-500/20 px-4 py-2 text-left text-gray-300">Harga</th>
                                    <th class="border border-pink-500/20 px-4 py-2 text-left text-gray-300">Stok</th>
                                    <th class="border border-pink-500/20 px-4 py-2 text-left text-gray-300">Kategori</th>
                                    <th class="border border-pink-500/20 px-4 py-2 text-left text-gray-300">Gambar</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-pink-500/10">
                                @foreach($produk as $item)
                                <tr class="hover:bg-zinc-800/50 transition-colors">
                                    <td class="border border-pink-500/20 px-4 py-2 text-gray-300 nomor"></td>
                                    <td class="border border-pink-500/20 px-4 py-2 text-gray-300">{{ $item->nama }}</td>
                                    <td class="border border-pink-500/20 px-4 py-2 text-gray-300">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="border border-pink-500/20 px-4 py-2">
                                        <span class="px-2 py-1 rounded text-sm
                                            @if($item->stok > 10) text-green-400
                                            @elseif($item->stok > 0) text-yellow-400
                                            @else text-red-400
                                            @endif">
                                            {{ $item->stok }}
                                        </span>
                                    </td>
                                    <td class="border border-pink-500/20 px-4 py-2 text-gray-300">{{ $item->kategori->nama_kategori }}</td>
                                    <td class="border border-pink-500/20 px-4 py-2">
                                        @if($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" 
                                                 alt="{{ $item->nama }}" 
                                                 class="h-12 w-12 object-cover rounded">
                                        @else
                                            <div class="h-12 w-12 bg-zinc-800 flex items-center justify-center rounded">
                                                <i class="fas fa-image text-zinc-600"></i>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    // Fungsi untuk update nomor urut
    function updateRowNumbers() {
        $("table tbody tr:visible").each(function(index) {
            $(this).find('td.nomor').text(index + 1);
        });
    }

    // Jalankan penomoran saat halaman dimuat
    updateRowNumbers();

    // Search function
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        updateRowNumbers(); // Update nomor setelah filtering
    });

    // Show entries function
    $("#showEntries").on("change", function() {
        var value = parseInt($(this).val());
        var rows = $("table tbody tr").length;
        
        $("table tbody tr").hide();
        $("table tbody tr").slice(0, Math.min(value, rows)).show();
        updateRowNumbers(); // Update nomor setelah mengubah jumlah entries
    });

    // Inisialisasi show entries
    $("#showEntries").trigger('change');
});
</script>
@endsection