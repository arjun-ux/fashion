@extends('components.admin-app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#1A1A1A] via-[#0A0A0A] to-black">
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('admin.produk.index') }}" class="text-lg font-semibold flex items-center text-[#DAA520]">
                <i class="fas fa-arrow-left mr-2"></i> 
                <span class="bg-[#1A1A1A]/80 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm border border-[#DAA520]/30">Tambah Produk</span>
            </a>
        </div>

        <div class="bg-[#1A1A1A]/80 backdrop-blur-sm rounded-xl shadow-lg p-8 border border-[#DAA520]/30">
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-[#DAA520] mb-1">Nama Produk*</label>
                        <input type="text" name="nama" 
                               class="w-full bg-[#0A0A0A] border border-[#DAA520]/30 rounded-lg shadow-sm focus:ring-2 focus:ring-[#DAA520] p-2.5 text-gray-300"
                               placeholder="Masukkan Nama">
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#DAA520] mb-1">Harga*</label>
                        <input type="number" name="harga" 
                               class="w-full bg-[#0A0A0A] border border-[#DAA520]/30 rounded-lg shadow-sm focus:ring-2 focus:ring-[#DAA520] p-2.5 text-gray-300"
                               placeholder="Masukkan Harga">
                        @error('harga')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#DAA520] mb-1">Stok*</label>
                        <input type="number" name="stok" 
                               class="w-full bg-[#0A0A0A] border border-[#DAA520]/30 rounded-lg shadow-sm focus:ring-2 focus:ring-[#DAA520] p-2.5 text-gray-300"
                               placeholder="Masukkan Stok">
                        @error('stok')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#DAA520] mb-1">Kategori*</label>
                        <select name="kategori_id" 
                                class="w-full bg-[#0A0A0A] border border-[#DAA520]/30 rounded-lg shadow-sm focus:ring-2 focus:ring-[#DAA520] p-2.5 text-gray-300">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-[#DAA520] mb-1">Gambar</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-[#DAA520]/30 border-dashed rounded-lg cursor-pointer hover:bg-[#DAA520]/5 bg-[#0A0A0A]"
                             onclick="document.getElementById('gambar').click();">
                            <div class="space-y-1 text-center">
                                <div id="preview" class="mb-4 hidden">
                                    <img id="imagePreview" class="mx-auto h-32 w-32 object-cover rounded-lg shadow-md border border-[#DAA520]/30">
                                </div>
                                <div id="placeholder" class="flex flex-col items-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-[#DAA520] mb-3"></i>
                                    <p class="text-sm text-gray-400">Upload a File</p>
                                    <p class="text-xs text-gray-500">Drag and drop files here</p>
                                </div>
                                <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*" 
                                       onchange="previewImage(this);">
                            </div>
                        </div>
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex space-x-3 mt-8">
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-[#DAA520] to-[#B8860B] hover:from-[#B8860B] hover:to-[#8B6914] text-black font-medium py-3 rounded-lg transition duration-300 shadow-lg">
                        Simpan
                    </button>
                    <a href="{{ route('admin.produk.index') }}" 
                       class="flex-1 bg-[#1A1A1A] border border-[#DAA520]/30 text-gray-300 py-3 rounded-lg text-center hover:bg-[#0A0A0A] transition duration-300 shadow-lg">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');
    const imagePreview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Prevent form submission when dragging files
const dropZone = document.querySelector('div[onclick="document.getElementById(\'gambar\').click();"]');
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults (e) {
    e.preventDefault();
    e.stopPropagation();
}

// Handle dropped files
dropZone.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    const input = document.getElementById('gambar');
    
    input.files = files;
    previewImage(input);
}
</script>
@endsection