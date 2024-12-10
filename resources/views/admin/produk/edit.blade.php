@extends('components.admin-app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-zinc-900 via-gray-900 to-black bg-fixed">
   <div class="container mx-auto px-4 py-8">
       <div class="mb-6">
           <a href="{{ route('admin.produk.index') }}" class="text-lg font-semibold flex items-center text-zinc-300">
               <i class="fas fa-arrow-left mr-2"></i> 
               <span class="bg-zinc-900/80 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm border border-pink-900/30">Edit Produk</span>
           </a>
       </div>

       <div class="bg-zinc-900/80 backdrop-blur-sm rounded-xl shadow-lg p-8 border border-pink-900/30">
           <!-- Error Messages -->
           @if ($errors->any())
               <div class="mb-6 bg-red-900/30 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg relative" role="alert">
                   <ul class="list-disc list-inside">
                       @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
           @endif

           <!-- Success Message -->
           @if(session('success'))
               <div class="mb-6 bg-green-900/30 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg relative" role="alert">
                   <p>{{ session('success') }}</p>
               </div>
           @endif

           <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
               <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                   <!-- Nama Produk -->
                   <div>
                       <label class="block text-sm font-medium text-zinc-300 mb-1">Nama Produk*</label>
                       <input type="text" 
                              name="nama" 
                              value="{{ old('nama', $produk->nama) }}"
                              class="w-full bg-black/50 border border-pink-900/30 rounded-lg shadow-sm focus:ring-2 focus:ring-pink-500 p-2.5 text-zinc-300 @error('nama') border-red-500 @enderror" 
                              placeholder="Masukkan nama produk">
                       @error('nama')
                           <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                       @enderror
                   </div>

                   <!-- Harga -->
                   <div>
                       <label class="block text-sm font-medium text-zinc-300 mb-1">Harga*</label>
                       <input type="number" 
                              name="harga" 
                              value="{{ old('harga', $produk->harga) }}"
                              class="w-full bg-black/50 border border-pink-900/30 rounded-lg shadow-sm focus:ring-2 focus:ring-pink-500 p-2.5 text-zinc-300 @error('harga') border-red-500 @enderror"
                              placeholder="Masukkan harga">
                       @error('harga')
                           <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                       @enderror
                   </div>

                   <!-- Stok -->
                   <div>
                       <label class="block text-sm font-medium text-zinc-300 mb-1">Stok*</label>
                       <input type="number" 
                              name="stok" 
                              value="{{ old('stok', $produk->stok) }}"
                              class="w-full bg-black/50 border border-pink-900/30 rounded-lg shadow-sm focus:ring-2 focus:ring-pink-500 p-2.5 text-zinc-300 @error('stok') border-red-500 @enderror"
                              placeholder="Masukkan stok">
                       @error('stok')
                           <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                       @enderror
                   </div>

                   <!-- Kategori -->
                   <div>
                       <label class="block text-sm font-medium text-zinc-300 mb-1">Kategori*</label>
                       <select name="kategori_id" 
                               class="w-full bg-black/50 border border-pink-900/30 rounded-lg shadow-sm focus:ring-2 focus:ring-pink-500 p-2.5 text-zinc-300 @error('kategori_id') border-red-500 @enderror">
                           <option value="">Pilih Kategori</option>
                           @foreach($kategori as $kat)
                               <option value="{{ $kat->id }}" {{ old('kategori_id', $produk->kategori_id) == $kat->id ? 'selected' : '' }}>
                                   {{ $kat->nama_kategori }}
                               </option>
                           @endforeach
                       </select>
                       @error('kategori_id')
                           <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                       @enderror
                   </div>

                   <!-- Gambar -->
                   <div class="col-span-2">
                       <label class="block text-sm font-medium text-zinc-300 mb-1">Gambar</label>
                       <div class="mt-1 flex items-center gap-4">
                           @if($produk->gambar)
                               <div class="relative group">
                                   <img src="{{ asset($produk->gambar) }}" 
                                        alt="{{ $produk->nama }}"
                                        class="w-32 h-32 object-cover rounded-lg border border-pink-900/30">
                                   <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                       <span class="text-zinc-200 text-sm">Gambar Saat Ini</span>
                                   </div>
                               </div>
                           @endif
                           <div class="flex-1">
                               <div class="border-2 border-pink-900/30 border-dashed rounded-lg p-4 text-center cursor-pointer hover:bg-zinc-800/50 bg-black/50 @error('gambar') border-red-500 @enderror"
                                    onclick="document.getElementById('gambar').click();">
                                   <div id="preview" class="mb-4 hidden">
                                       <img id="imagePreview" class="mx-auto h-32 w-32 object-cover rounded-lg">
                                   </div>
                                   <div id="placeholder">
                                       <i class="fas fa-cloud-upload-alt text-3xl mb-2 text-pink-500"></i>
                                       <p class="text-sm text-zinc-400">Klik atau seret gambar untuk mengganti</p>
                                   </div>
                                   <input type="file" 
                                          name="gambar" 
                                          id="gambar" 
                                          class="hidden" 
                                          accept="image/*"
                                          onchange="previewImage(this);">
                               </div>
                               @error('gambar')
                                   <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                               @enderror
                           </div>
                       </div>
                   </div>
               </div>

               <!-- Tombol -->
               <div class="flex space-x-3 mt-8">
                   <button type="submit" 
                           class="flex-1 bg-gradient-to-r from-pink-600 to-purple-800 text-white py-3 rounded-lg hover:from-pink-700 hover:to-purple-900 transition duration-300 shadow-lg">
                       Update Produk
                   </button>
                   <a href="{{ route('admin.produk.index') }}" 
                      class="flex-1 bg-gradient-to-r from-zinc-700 to-zinc-800 text-white py-3 rounded-lg text-center hover:from-zinc-800 hover:to-zinc-900 transition duration-300 shadow-lg">
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
</script>
@endsection