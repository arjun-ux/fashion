@extends('components.admin-app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.8)), url('https://images.pexels.com/photos/29625971/pexels-photo-29625971.jpeg'); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-black/80 backdrop-blur-sm rounded-xl shadow-lg p-8 border border-red-500/20">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center text-red-500">
                    <i class="fas fa-tshirt w-8 h-8 mr-3"></i>
                    <h1 class="text-2xl font-bold tracking-wider">PRODUCTS MANAGEMENT</h1>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 mb-6">
                <form action="{{ route('admin.reports.pdf') }}" method="GET" class="inline">
                    <input type="hidden" name="type" value="products">
                    <input type="hidden" name="period" value="daily">
                    <button type="submit" 
                            class="bg-black hover:bg-gray-900 border border-red-500/20 text-gray-200 px-4 py-2 rounded-lg transition-all duration-300 flex items-center gap-2">
                        <i class="fas fa-file-pdf text-red-500"></i>
                        Daily Report
                    </button>
                </form>

                <form action="{{ route('admin.reports.pdf') }}" method="GET" class="inline">
                    <input type="hidden" name="type" value="products">
                    <input type="hidden" name="period" value="monthly">
                    <button type="submit" 
                            class="bg-black hover:bg-gray-900 border border-red-500/20 text-gray-200 px-4 py-2 rounded-lg transition-all duration-300 flex items-center gap-2">
                        <i class="fas fa-file-pdf text-red-500"></i>
                        Monthly Report
                    </button>
                </form>

                <form action="{{ route('admin.reports.pdf') }}" method="GET" class="inline">
                    <input type="hidden" name="type" value="products">
                    <input type="hidden" name="period" value="yearly">
                    <button type="submit" 
                            class="bg-black hover:bg-gray-900 border border-red-500/20 text-gray-200 px-4 py-2 rounded-lg transition-all duration-300 flex items-center gap-2">
                        <i class="fas fa-file-pdf text-red-500"></i>
                        Yearly Report
                    </button>
                </form>

                <a href="{{ route('admin.produk.create') }}" 
                   class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-2 rounded-lg flex items-center transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Add Product
                </a>
            </div>

            <div class="bg-black/90 rounded-lg shadow-xl border border-red-500/10">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center text-gray-300">
                            <span>Show</span>
                            <select class="mx-3 bg-black/80 border border-red-500/20 rounded-lg px-4 py-2" id="showEntries">
                                @foreach([10, 25, 50] as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <span>entries</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3 text-gray-300">Search:</span>
                            <input type="text" id="searchInput" 
                                   class="bg-black/80 border border-red-500/20 rounded-lg px-4 py-2 w-64 text-gray-300 focus:border-red-500 focus:ring-1 focus:ring-red-500" 
                                   placeholder="Search...">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border border-red-500/20">
                            <thead>
                                <tr class="bg-black">
                                    <th class="border border-red-500/20 px-6 py-4 text-left text-lg text-red-500 font-medium">Product ID</th>
                                    <th class="border border-red-500/20 px-6 py-4 text-left text-lg text-red-500 font-medium">Name</th>
                                    <th class="border border-red-500/20 px-6 py-4 text-left text-lg text-red-500 font-medium">Price</th>
                                    <th class="border border-red-500/20 px-6 py-4 text-left text-lg text-red-500 font-medium">Stock</th>
                                    <th class="border border-red-500/20 px-6 py-4 text-left text-lg text-red-500 font-medium">Category</th>
                                    <th class="border border-red-500/20 px-6 py-4 text-left text-lg text-red-500 font-medium">Image</th>
                                    <th class="border border-red-500/20 px-6 py-4 text-left text-lg text-red-500 font-medium">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produk as $item)
                                <tr class="hover:bg-red-500/5 transition-all duration-200">
                                    <td class="border border-red-500/20 px-6 py-4 text-gray-300">{{ $item->kode_produk }}</td>
                                    <td class="border border-red-500/20 px-6 py-4 text-gray-300">{{ $item->nama }}</td>
                                    <td class="border border-red-500/20 px-6 py-4 text-gray-300">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="border border-red-500/20 px-6 py-4 text-gray-300">{{ $item->stok }}</td>
                                    <td class="border border-red-500/20 px-6 py-4 text-gray-300">{{ $item->kategori->nama_kategori }}</td>
                                    <td class="border border-red-500/20 px-6 py-4">
                                        @if($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" 
                                                 alt="{{ $item->nama }}" 
                                                 class="h-32 w-32 object-cover rounded-lg border border-red-500/20 hover:scale-150 transition-transform duration-300 cursor-zoom-in">
                                        @else
                                            <div class="h-32 w-32 bg-black flex items-center justify-center rounded-lg border border-red-500/20">
                                                <i class="fas fa-image text-3xl text-red-500/50"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="border border-red-500/20 px-6 py-4">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('admin.produk.edit', $item->id) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-lg transition-all duration-300">
                                                <i class="fas fa-edit mr-2"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')" 
                                                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-all duration-300">
                                                    <i class="fas fa-trash mr-2"></i> Delete
                                                </button>
                                            </form>
                                        </div>
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
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#showEntries").on("change", function() {
        var value = parseInt($(this).val());
        var rows = $("table tbody tr").length;
        
        $("table tbody tr").hide();
        $("table tbody tr").slice(0, Math.min(value, rows)).show();
    });
});
</script>
@endsection