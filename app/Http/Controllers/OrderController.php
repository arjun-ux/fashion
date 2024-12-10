<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $products = Produk::where('stok', '>', 0)->get();
            $orders = Order::with('produk')->latest()->take(10)->get();
            return view('kasir.penjualan.index', compact('products', 'orders'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'regex:/^[\pL\s\-]+$/u'
            ],
            'product_name' => [
                'required',
                'string',
                'exists:products,nama'
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0'
            ],
            'total_price' => [
                'required',
                'numeric',
                'min:0'
            ]
        ], [
            'customer_name.required' => 'Nama pembeli wajib diisi',
            'customer_name.string' => 'Nama pembeli harus berupa teks',
            'customer_name.max' => 'Nama pembeli maksimal 255 karakter',
            'customer_name.min' => 'Nama pembeli minimal 1 karakter',
            'customer_name.regex' => 'Nama pembeli hanya boleh mengandung huruf, spasi, dan tanda hubung',
            'product_name.required' => 'Nama produk wajib diisi',
            'product_name.exists' => 'Produk yang dipilih tidak valid',
            'quantity.required' => 'Jumlah wajib diisi',
            'quantity.integer' => 'Jumlah harus berupa angka bulat',
            'quantity.min' => 'Jumlah minimal 1',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh negatif',
            'total_price.required' => 'Total harga wajib diisi',
            'total_price.numeric' => 'Total harga harus berupa angka',
            'total_price.min' => 'Total harga tidak boleh negatif'
        ]);
    
        try {
            DB::beginTransaction();
    
            // Ambil produk berdasarkan nama
            $product = Produk::where('nama', $request->product_name)->firstOrFail();
    
            // Validasi stok
            if ($product->stok < $request->quantity) {
                return back()->with('error', "Stok tidak mencukupi. Stok tersedia: {$product->stok}")
                             ->withInput();
            }
    
            // Simpan order baru
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'product_id' => $product->id,
                'product_name' => $request->product_name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total_price' => $request->total_price,
                'payment_status' => 'paid'
            ]);
    
            // Update stok produk
            $product->update([
                'stok' => $product->stok - $request->quantity
            ]);
    
            DB::commit();
            return redirect()->route('order.print', $order->id);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage())
                        ->withInput();
        }
    }
    
    public function edit($id)
    {
        try {
            $order = Order::findOrFail($id);
            return response()->json($order);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:255',
                'min:1',
                'regex:/^[\pL\s\-]+$/u'
            ],
            'product_name' => [
                'required',
                'string',
                'exists:products,nama'
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],
            'price' => [
                'required',
                'numeric',
                'min:0'
            ],
            'total_price' => [
                'required',
                'numeric',
                'min:0'
            ],
            'payment_status' => [
                'required',
                'in:paid,unpaid'
            ]
        ], [
            'customer_name.required' => 'Nama pembeli wajib diisi',
            'customer_name.string' => 'Nama pembeli harus berupa teks',
            'customer_name.max' => 'Nama pembeli maksimal 255 karakter',
            'customer_name.min' => 'Nama pembeli min 2 karakter',
            'customer_name.regex' => 'Nama pembeli hanya boleh mengandung huruf, spasi, dan tanda hubung',
            'product_name.required' => 'Nama produk wajib diisi',
            'product_name.exists' => 'Produk yang dipilih tidak valid',
            'quantity.required' => 'Jumlah wajib diisi',
            'quantity.integer' => 'Jumlah harus berupa angka bulat',
            'quantity.min' => 'Jumlah minimal 1',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh negatif',
            'total_price.required' => 'Total harga wajib diisi',
            'total_price.numeric' => 'Total harga harus berupa angka',
            'total_price.min' => 'Total harga tidak boleh negatif',
            'payment_status.required' => 'Status pembayaran wajib diisi',
            'payment_status.in' => 'Status pembayaran tidak valid'
        ]);

        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $newProduct = Produk::where('nama', $request->product_name)->firstOrFail();
            $oldProduct = Produk::findOrFail($order->product_id);

            // Kembalikan stok lama
            $oldProduct->update([
                'stok' => $oldProduct->stok + $order->quantity
            ]);

            // Cek stok baru
            if ($newProduct->stok < $request->quantity) {
                DB::rollBack();
                return back()->with('error', "Stok tidak mencukupi. Stok tersedia: {$newProduct->stok}")
                           ->withInput();
            }

            // Kurangi stok baru
            $newProduct->update([
                'stok' => $newProduct->stok - $request->quantity
            ]);

            // Update order
            $order->update([
                'customer_name' => $request->customer_name,
                'product_id' => $newProduct->id,
                'product_name' => $request->product_name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total_price' => $request->total_price,
                'payment_status' => $request->payment_status
            ]);

            DB::commit();
            return redirect()->route('kasir.dashboard')
                           ->with('success', 'Transaksi berhasil diupdate');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengupdate transaksi: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $product = Produk::findOrFail($order->product_id);
            
            // Kembalikan stok
            $product->update([
                'stok' => $product->stok + $order->quantity
            ]);

            $order->delete();

            DB::commit();
            return back()->with('success', 'Transaksi berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }

    public function history()
    {
        try {
            $orders = Order::with('produk')->latest()->paginate(10);
            return view('kasir.orders.history', compact('orders'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat riwayat');
        }
    }

    public function print($id)
    {
        try {
            $order = Order::with('produk')->findOrFail($id);
            $pdf = PDF::loadView('kasir.orders.receipt', compact('order'));
            return $pdf->stream('receipt-'.$order->id.'.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mencetak struk: ' . $e->getMessage());
        }
    }
}