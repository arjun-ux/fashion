@extends('components.admin-app')

@section('content')
<div class="min-h-screen bg-[#0F172A]">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-gray-900/80 backdrop-blur-sm rounded-xl shadow-lg p-8 border border-red-500/30">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <i class="fas fa-tags w-8 h-8 mr-3 text-red-500"></i>
                    <h1 class="text-2xl font-semibold text-red-500">KELOLA KATEGORI</h1>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-gray-900/50 border-l-4 border-red-500 text-gray-300 p-6 mb-6 text-lg" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-gray-900/50 rounded-lg shadow-md">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center text-gray-300 text-lg">
                            <span>Show</span>
                            <select class="mx-3 bg-gray-900 border border-red-500/30 rounded-lg px-4 py-2" id="showEntries">
                                @foreach([10, 25, 50] as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <span>entries</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3 text-gray-300 text-lg">Search:</span>
                            <input type="text" id="searchInput" 
                                   class="bg-gray-900 border border-red-500/30 rounded-lg px-4 py-2 w-64 text-gray-300 focus:border-red-500 focus:ring-1 focus:ring-red-500" 
                                   placeholder="Search...">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border border-red-500/30">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-900 to-gray-800">
                                    <th class="border border-red-500/30 px-6 py-4 text-left text-lg text-red-500 font-medium">No</th>
                                    <th class="border border-red-500/30 px-6 py-4 text-left text-lg text-red-500 font-medium">Nama Kategori</th>
                                    <th class="border border-red-500/30 px-6 py-4 text-left text-lg text-red-500 font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategori as $index => $kat)
                                <tr class="hover:bg-red-500/5 transition-all duration-200">
                                    <td class="border border-red-500/30 px-6 py-4 text-gray-300">{{ $index + 1 }}</td>
                                    <td class="border border-red-500/30 px-6 py-4 text-gray-300">{{ $kat->nama_kategori }}</td>
                                    <td class="border border-red-500/30 px-6 py-4">
                                        <div class="flex space-x-3">
                                            <button onclick="editKategori({{ $kat->id }}, '{{ $kat->nama_kategori }}')" 
                                                    class="bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-lg transition-all duration-300">
                                                <i class="fas fa-edit mr-2"></i> Edit
                                            </button>
                                            <button onclick="deleteKategori({{ $kat->id }})" 
                                                    class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium px-4 py-2 rounded-lg transition-all duration-300">
                                                <i class="fas fa-trash mr-2"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <button onclick="openModal()" 
                        class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium px-6 py-3 rounded-lg flex items-center w-fit transition-all duration-300 text-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kategori
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    <div id="kategoriModal" class="fixed inset-0 bg-black bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-6 border border-red-500/30 w-[480px] shadow-lg rounded-xl bg-gray-900/90 backdrop-blur-sm">
            <div class="mt-3">
                <h3 class="text-2xl font-semibold text-red-500" id="modalTitle">Tambah Kategori</h3>
                <form id="kategoriForm" method="POST" action="{{ route('admin.kategori.store') }}" class="mt-6">
                    @csrf
                    <div id="methodField"></div>
                    <div class="mb-6">
                        <label class="block text-red-500 text-lg font-medium mb-2">Nama Kategori*</label>
                        <input type="text" name="nama_kategori" id="nama_kategori"
                               class="bg-gray-800 border @error('nama_kategori') border-red-600 @else border-red-500/30 @enderror text-gray-300 rounded-lg w-full py-3 px-4 text-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500"
                               value="{{ old('nama_kategori') }}"
                               required>
                        @error('nama_kategori')
                            <div class="mt-2 bg-red-900/50 border-l-4 border-red-600 text-red-200 p-4 rounded">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal()"
                                class="bg-gray-800 text-gray-300 px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors border border-red-500/30 text-lg">
                            Batal
                        </button>
                        <button type="submit"
                                class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 text-lg">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-6 border border-red-500/30 w-[480px] shadow-lg rounded-xl bg-gray-900/90 backdrop-blur-sm">
            <div class="mt-3 text-center">
                <h3 class="text-2xl font-semibold text-red-500">Konfirmasi Hapus</h3>
                <div class="mt-4 px-7 py-3">
                    <p class="text-gray-300 text-lg">Apakah Anda yakin ingin menghapus kategori ini?</p>
                </div>
                <div class="flex justify-center gap-3 mt-6">
                    <button onclick="closeDeleteModal()"
                            class="bg-gray-800 text-gray-300 px-6 py-3 rounded-lg hover:bg-gray-700 transition-colors border border-red-500/30 text-lg">
                        Batal
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium px-6 py-3 rounded-lg transition-all duration-300 text-lg">
                            Hapus
                        </button>
                    </form>
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

    // Trigger show entries on page load
    $("#showEntries").trigger('change');
});

@if($errors->any())
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('kategoriModal').classList.remove('hidden');
    });
@endif

function openModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Kategori';
    document.getElementById('kategoriForm').action = "{{ route('admin.kategori.store') }}";
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('nama_kategori').value = '{{ old('nama_kategori') }}';
    document.getElementById('kategoriModal').classList.remove('hidden');
}

function editKategori(id, nama) {
    document.getElementById('modalTitle').textContent = 'Edit Kategori';
    document.getElementById('kategoriForm').action = `/admin/kategori/${id}`;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
    document.getElementById('nama_kategori').value = nama;
    document.getElementById('kategoriModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('kategoriModal').classList.add('hidden');
}

function deleteKategori(id) {
    document.getElementById('deleteForm').action = `/admin/kategori/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

window.onclick = function(event) {
    const modal = document.getElementById('kategoriModal');
    const deleteModal = document.getElementById('deleteModal');
    if (event.target == modal) {
        closeModal();
    }
    if (event.target == deleteModal) {
        closeDeleteModal();
    }
}
</script>
@endsection
