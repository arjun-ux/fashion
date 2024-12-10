@extends('components.kasir-app')

@section('content')
<div class="bg-zinc-900/80 rounded-lg p-6 border border-pink-500/20">
<h1 class="text-2xl font-bold mb-6 neon-glow" style="color: rgb(234, 61, 61);">Transaksi Penjualan</h1>

    <!-- Notifikasi -->
    @if(session('error'))
    <div class="mb-6">
        <div class="bg-red-500/20 text-red-400 p-4 rounded-lg border border-red-500/20">
            <div class="flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    </div>
    @endif

    @if(session('success'))
    <div class="mb-6">
        <div class="bg-green-500/20 text-green-400 p-4 rounded-lg border border-green-500/20">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    </div>
    @endif

    
    <!-- Form Transaksi -->
    <form action="{{ route('order.store') }}" method="POST" class="mb-8 bg-zinc-800/50 p-6 rounded-lg border border-pink-500/20">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Nama Pembeli</label>
                <input type="text" name="customer_name" required value="{{ old('customer_name') }}"
                    class="w-full bg-zinc-900/50 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100 focus:border-pink-500/50 transition-colors">
                    @error('customer_name')
    <div class="text-red-400">{{ $message }}</div>
@enderror

            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Cari Produk</label>
                <select id="product_search" name="product_name" required
                    class="w-full bg-zinc-900/50 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100 focus:border-pink-500/50 transition-colors">
                    <option value="">Pilih Produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->nama }}" 
                                data-price="{{ $product->harga }}" 
                                data-stock="{{ $product->stok }}"
                                {{ old('product_name') == $product->nama ? 'selected' : '' }}>
                            {{ $product->nama }} - Stok: {{ $product->stok }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Harga</label>
                <input type="number" name="price" id="price" readonly value="{{ old('price') }}"
                    class="w-full bg-zinc-900/60 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Jumlah</label>
                <input type="number" name="quantity" id="quantity" min="1" required value="{{ old('quantity') }}"
                    class="w-full bg-zinc-900/50 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100 focus:border-pink-500/50 transition-colors">
                <span id="stock-warning" class="text-sm text-red-400 mt-1 hidden"></span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Total Harga</label>
                <input type="number" name="total_price" id="total_price" readonly value="{{ old('total_price') }}"
                    class="w-full bg-zinc-900/60 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" id="submit-btn" class="btn-glow text-white font-bold py-2 px-6 rounded-lg">
                Proses Transaksi
            </button>
        </div>
    </form>

    <!-- Tabel Transaksi -->
    <div class="overflow-x-auto">
        <table class="w-full text-gray-100">
            <thead class="bg-zinc-800/80 border-b border-pink-500/20">
                <tr>
                    <th class="px-6 py-3 text-left">No.</th>
                    <th class="px-6 py-3 text-left">Pembeli</th>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Jumlah</th>
                    <th class="px-6 py-3 text-left">Harga</th>
                    <th class="px-6 py-3 text-left">Total</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Waktu</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pink-500/20">
                @foreach($orders as $order)
                <tr class="hover:bg-zinc-800/40 transition-colors">
                    <td class="px-6 py-4 nomor"></td> <!-- Ubah bagian ini -->
                    <td class="px-6 py-4">{{ $order->customer_name }}</td>
                    <td class="px-6 py-4">{{ $order->product_name }}</td>
                    <td class="px-6 py-4">{{ $order->quantity }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs 
                            {{ $order->payment_status === 'paid' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                            {{ $order->payment_status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-center flex justify-center space-x-2">
                        <button onclick="editOrder({{ $order->id }})" 
                            class="btn-glow px-3 py-1 rounded inline-flex items-center">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </button>

                        <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus transaksi ini?')"
                                class="btn-glow bg-red-500/20 hover:bg-red-500/30 px-3 py-1 rounded inline-flex items-center">
                                <i class="fas fa-trash mr-2"></i> Hapus
                            </button>
                        </form>

                        <a href="{{ route('order.print', $order->id) }}" target="_blank"
                            class="btn-glow px-3 py-1 rounded inline-flex items-center">
                            <i class="fas fa-print mr-2"></i> Cetak
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
<div class="bg-zinc-900 p-6 rounded-lg w-full max-w-2xl border border-pink-500/20">
    <h2 class="text-xl font-bold text-pink-400 mb-4">Edit Transaksi</h2>
    
    <form id="editForm" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Nama Pembeli</label>
                <input type="text" name="customer_name" id="edit_customer_name" required
                    class="w-full bg-zinc-900/50 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100">
            </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Produk</label>
                    <select name="product_name" id="edit_product_id" required
                        class="w-full bg-zinc-900/50 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100">
                        @foreach($products as $product)
                            <option value="{{ $product->nama }}" 
                                    data-price="{{ $product->harga }}" 
                                    data-stock="{{ $product->stok }}">
                                {{ $product->nama }} - Stok: {{ $product->stok }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Jumlah</label>
                    <input type="number" name="quantity" id="edit_quantity" required min="1"
                        class="w-full bg-zinc-900/50 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100">
                    <span id="edit_stock_warning" class="text-sm text-red-400 mt-1 hidden"></span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Harga</label>
                    <input type="number" name="price" id="edit_price" required readonly
                        class="w-full bg-zinc-900/60 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Total Harga</label>
                    <input type="number" name="total_price" id="edit_total_price" required readonly
                        class="w-full bg-zinc-900/60 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Status Pembayaran</label>
                    <select name="payment_status" id="edit_payment_status" required
                        class="w-full bg-zinc-900/50 border border-pink-500/20 rounded-lg px-4 py-2 text-gray-100">
                        <option value="paid">Dibayar</option>
                        <option value="unpaid">Belum Dibayar</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-6">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 bg-zinc-700 rounded-lg hover:bg-zinc-600 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="btn-glow text-white font-bold py-2 px-6 rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    function updateRowNumbers() {
        const rows = document.querySelectorAll('td.nomor');
        rows.forEach((cell, index) => {
            cell.textContent = index + 1;
        });
    }
    
    // Jalankan penomoran saat halaman dimuat
    updateRowNumbers();

    // Panggil updateRowNumbers setelah operasi yang mengubah tabel
    const deleteForms = document.querySelectorAll('form');
    deleteForms.forEach(form => {
        if(form.method.toLowerCase() === 'post' && form.action.includes('destroy')) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if(confirm('Yakin ingin menghapus transaksi ini?')) {
                    const row = this.closest('tr');
                    fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            row.remove();
                            updateRowNumbers(); // Update nomor setelah menghapus
                            showNotification('Data berhasil dihapus', 'success');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Gagal menghapus data', 'error');
                    });
                }
            });
        }
    });
    // Form elements
    const productSelect = document.getElementById('product_search');
    const priceInput = document.getElementById('price');
    const quantityInput = document.getElementById('quantity');
    const totalPriceInput = document.getElementById('total_price');
    const stockWarning = document.getElementById('stock-warning');
    const submitBtn = document.getElementById('submit-btn');

    // Product select change handler
    productSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (!selectedOption.value) {
            resetForm();
            return;
        }

        const price = selectedOption.dataset.price;
        const stock = parseInt(selectedOption.dataset.stock);
        
        priceInput.value = price;
        quantityInput.value = '';
        quantityInput.max = stock;
        totalPriceInput.value = '';
        
        stockWarning.classList.add('hidden');
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    });

    // Quantity input handler
    quantityInput.addEventListener('input', function() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        if (!selectedOption.value) {
            this.value = '';
            showNotification('Pilih produk terlebih dahulu!', 'warning');
            return;
        }

        const stock = parseInt(selectedOption.dataset.stock);
        const quantity = parseInt(this.value) || 0;

        if (quantity > stock) {
            showNotification(`Stok tidak mencukupi! Stok tersedia: ${stock}`, 'error');
            stockWarning.textContent = `Stok tidak mencukupi! Maksimal: ${stock}`;
            stockWarning.classList.remove('hidden');
            this.value = stock;
        } else if (quantity <= 0) {
            stockWarning.textContent = 'Jumlah minimal adalah 1';
            stockWarning.classList.remove('hidden');
        } else {
            stockWarning.classList.add('hidden');
        }
        
        calculateTotal();
    });

    // Reset form function
    function resetForm() {
        priceInput.value = '';
        quantityInput.value = '';
        totalPriceInput.value = '';
        stockWarning.classList
        stockWarning.classList.add('hidden');
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    }

    // Calculate total function
    function calculateTotal() {
        const price = parseFloat(priceInput.value) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        totalPriceInput.value = price * quantity;
    }
    // Tambahkan di sini - setelah fungsi calculateEditTotal dan sebelum event listener modal
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    fetch(this.action, {
        method: 'POST',
        body: new FormData(this),
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            closeEditModal();
            location.reload(); // Setelah reload, nomor akan diperbarui otomatis
            showNotification('Data berhasil diperbarui', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Gagal memperbarui data', 'error');
    });
});

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

    // Show notification function
    function showNotification(message, type = 'error') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg border shadow-lg z-50 animate-fade-in ${
            type === 'error' 
                ? 'bg-red-500/20 text-red-400 border-red-500/20' 
                : 'bg-yellow-500/20 text-yellow-400 border-yellow-500/20'
        }`;
        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'exclamation-triangle'}"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('animate-fade-out');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
});


// Edit Order Functions
function editOrder(orderId) {
    fetch(`/order/${orderId}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_customer_name').value = data.customer_name;
            document.getElementById('edit_product_id').value = data.product_name;
            document.getElementById('edit_quantity').value = data.quantity;
            document.getElementById('edit_price').value = data.price;
            document.getElementById('edit_total_price').value = data.total_price;
            document.getElementById('edit_payment_status').value = data.payment_status;
            
            document.getElementById('editForm').action = `/order/${orderId}`;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');

            calculateEditTotal();
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Gagal memuat data transaksi', 'error');
        });
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('flex');
    document.getElementById('editModal').classList.add('hidden');
}

// Edit form event listeners
const editProductSelect = document.getElementById('edit_product_id');
const editQuantityInput = document.getElementById('edit_quantity');
const editPriceInput = document.getElementById('edit_price');
const editTotalInput = document.getElementById('edit_total_price');
const editStockWarning = document.getElementById('edit_stock_warning');

editProductSelect.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const price = selectedOption.dataset.price;
    const stock = parseInt(selectedOption.dataset.stock);
    
    editPriceInput.value = price;
    editQuantityInput.value = '';
    editTotalInput.value = '';
    editStockWarning.classList.add('hidden');
    
    calculateEditTotal();
});

editQuantityInput.addEventListener('input', function() {
    const selectedOption = editProductSelect.options[editProductSelect.selectedIndex];
    const stock = parseInt(selectedOption.dataset.stock);
    const quantity = parseInt(this.value) || 0;

    if (quantity > stock) {
        editStockWarning.textContent = `Stok tidak mencukupi! Maksimal: ${stock}`;
        editStockWarning.classList.remove('hidden');
        this.value = stock;
    } else if (quantity <= 0) {
        editStockWarning.textContent = 'Jumlah minimal adalah 1';
        editStockWarning.classList.remove('hidden');
    } else {
        editStockWarning.classList.add('hidden');
    }
    
    calculateEditTotal();
});

function calculateEditTotal() {
    const price = parseFloat(editPriceInput.value) || 0;
    const quantity = parseInt(editQuantityInput.value) || 0;
    editTotalInput.value = price * quantity;
}

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Add styles for animations
const style = document.createElement('style');
style.textContent = `
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in;
    }
    .animate-fade-out {
        animation: fadeOut 0.3s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-20px); }
    }
`;
document.head.appendChild(style);
</script>
@endsection