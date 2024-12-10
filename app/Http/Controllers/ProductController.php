<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori; 
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
   public function index()
   {
       return view('admin.produk.index', [
           'produk' => Produk::with('kategori')->get(),
           'title' => 'Kelola Produk'
       ]);
   }

   public function create()
   {
       $kategori = Kategori::all();
       return view('admin.produk.create', compact('kategori'));
   }

   public function store(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'nama' => 'required|string|max:255|min:3|unique:products',
           'harga' => 'required|numeric|min:1000',
           'stok' => 'required|integer|min:1',
           'kategori_id' => 'required|exists:kategoris,id',
           'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
       ], [
           // Nama Produk
           'nama.required' => 'Nama produk wajib diisi',
           'nama.string' => 'Nama produk harus berupa teks',
           'nama.max' => 'Nama produk maksimal 255 karakter',
           'nama.min' => 'Nama produk minimal 3 karakter',
           'nama.unique' => 'Nama produk sudah digunakan',
           
           // Harga
           'harga.required' => 'Harga produk wajib diisi',
           'harga.numeric' => 'Harga harus berupa angka',
           'harga.min' => 'Harga minimal Rp 1.000',
           
           // Stok
           'stok.required' => 'Stok produk wajib diisi',
           'stok.integer' => 'Stok harus berupa angka bulat',
           'stok.min' => 'Stok minimal 1',
           
           // Kategori
           'kategori_id.required' => 'Kategori produk wajib dipilih',
           'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
           
           // Gambar
           'gambar.required' => 'Gambar produk wajib diupload',
           'gambar.image' => 'File yang diupload harus berupa gambar',
           'gambar.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif',
           'gambar.max' => 'Ukuran gambar maksimal 2MB'
       ]);

       if ($validator->fails()) {
           return redirect()
               ->back()
               ->withErrors($validator)
               ->withInput();
       }

       try {
           if ($request->hasFile('gambar')) {
               $gambar = $request->file('gambar');
               $nama_file = time()."_".$gambar->getClientOriginalName();
               $gambar->move(public_path('images/produk'), $nama_file);
               $gambarPath = 'images/produk/' . $nama_file;
           }

           Produk::create([
               'nama' => $request->nama,
               'harga' => $request->harga,
               'stok' => $request->stok,
               'kategori_id' => $request->kategori_id,
               'gambar' => $gambarPath ?? null,
           ]);

           return redirect()
               ->route('admin.produk.index')
               ->with('success', 'Produk berhasil ditambahkan.');

       } catch (\Exception $e) {
           // Jika terjadi error, hapus gambar yang sudah diupload (jika ada)
           if (isset($gambarPath) && file_exists(public_path($gambarPath))) {
               unlink(public_path($gambarPath));
           }

           return redirect()
               ->back()
               ->withInput()
               ->with('error', 'Terjadi kesalahan saat menambahkan produk. Silakan coba lagi.');
       }
   }

   public function edit($id)
   {
       $produk = Produk::findOrFail($id);
       $kategori = Kategori::all();
       return view('admin.produk.edit', compact('produk', 'kategori'));
   }

   public function update(Request $request, $id)
   {
       $validator = Validator::make($request->all(), [
           'nama' => 'required|string|max:255|min:3|unique:products,nama,'.$id,
           'harga' => 'required|numeric|min:1000',
           'stok' => 'required|integer|min:1',
           'kategori_id' => 'required|exists:kategoris,id',
           'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
       ], [
           // Nama Produk
           'nama.required' => 'Nama produk wajib diisi',
           'nama.string' => 'Nama produk harus berupa teks',
           'nama.max' => 'Nama produk maksimal 255 karakter',
           'nama.min' => 'Nama produk minimal 3 karakter',
           'nama.unique' => 'Nama produk sudah digunakan',
           
           // Harga
           'harga.required' => 'Harga produk wajib diisi',
           'harga.numeric' => 'Harga harus berupa angka',
           'harga.min' => 'Harga minimal Rp 1.000',
           
           // Stok
           'stok.required' => 'Stok produk wajib diisi',
           'stok.integer' => 'Stok harus berupa angka bulat',
           'stok.min' => 'Stok minimal 1',
           
           // Kategori
           'kategori_id.required' => 'Kategori produk wajib dipilih',
           'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
           
           // Gambar (Opsional saat update)
           'gambar.image' => 'File yang diupload harus berupa gambar',
           'gambar.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif',
           'gambar.max' => 'Ukuran gambar maksimal 2MB'
       ]);

       if ($validator->fails()) {
           return redirect()
               ->back()
               ->withErrors($validator)
               ->withInput();
       }

       try {
           $produk = Produk::findOrFail($id);
           $gambarPath = $produk->gambar; // Simpan path gambar lama

           // Handle gambar jika ada upload gambar baru
           if ($request->hasFile('gambar')) {
               // Hapus gambar lama jika ada
               if($produk->gambar && file_exists(public_path($produk->gambar))) {
                   unlink(public_path($produk->gambar));
               }
               
               // Upload gambar baru
               $gambar = $request->file('gambar');
               $nama_file = time()."_".$gambar->getClientOriginalName();
               $gambar->move(public_path('images/produk'), $nama_file);
               $gambarPath = 'images/produk/' . $nama_file;
           }

           // Update data produk
           $produk->update([
               'nama' => $request->nama,
               'harga' => $request->harga,
               'stok' => $request->stok,
               'kategori_id' => $request->kategori_id,
               'gambar' => $gambarPath
           ]);

           return redirect()
               ->route('admin.produk.index')
               ->with('success', 'Produk berhasil diupdate');

       } catch (\Exception $e) {
           // Jika terjadi error dan ada upload gambar baru, hapus gambar yang baru diupload
           if (isset($newGambarPath) && file_exists(public_path($newGambarPath))) {
               unlink(public_path($newGambarPath));
           }

           return redirect()
               ->back()
               ->withInput()
               ->with('error', 'Terjadi kesalahan saat mengupdate produk. Silakan coba lagi.');
       }
   }

   public function destroy($id)
   {
       try {
           $produk = Produk::findOrFail($id);
           
           // Check if there are any related orders
           $hasOrders = Order::where('product_id', $id)->exists();
           
           if ($hasOrders) {
               return redirect()
                   ->route('admin.produk.index')
                   ->with('error', 'Produk tidak dapat dihapus karena masih terdapat transaksi terkait. Pertimbangkan untuk menonaktifkan produk ini sebagai gantinya.');
           }

           // If no orders exist, proceed with deletion
           if ($produk->gambar && file_exists(public_path($produk->gambar))) {
               unlink(public_path($produk->gambar));
           }

           $produk->delete();
           return redirect()
               ->route('admin.produk.index')
               ->with('success', 'Produk berhasil dihapus');

       } catch (QueryException $e) {
           // Log the error for debugging
           \Log::error('Error deleting product:', [
               'product_id' => $id,
               'error' => $e->getMessage()
           ]);

           return redirect()
               ->route('admin.produk.index')
               ->with('error', 'Tidak dapat menghapus produk karena masih terdapat data terkait.');
       } catch (\Exception $e) {
           \Log::error('Unexpected error while deleting product:', [
               'product_id' => $id,
               'error' => $e->getMessage()
           ]);

           return redirect()
               ->route('admin.produk.index')
               ->with('error', 'Terjadi kesalahan saat menghapus produk.');
       }
   }

   public function search(Request $request)
   {
       $query = $request->get('q');
       
       $products = Produk::where('nama', 'like', "%{$query}%")
           ->where('stok', '>', 0)
           ->select('id', 'nama', 'harga', 'stok')
           ->get();

       return response()->json($products);
   }
}