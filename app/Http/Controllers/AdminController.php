<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk mengelola file

class AdminController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data statistik.
     */
    public function dashboard()
    {
        $totalProducts = Product::count();
        $pendingOrders = Order::where('status', 'pending')->count();

        // Menghitung total penjualan dari pesanan yang sudah dikonfirmasi, dikirim, atau selesai.
        $totalSales = Order::whereIn('status', ['confirmed', 'shipped', 'completed'])->sum('total_price');

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'pendingOrders' => $pendingOrders,
            'totalSales' => $totalSales,
        ]);
    }

    // =========================================================================
    // MANAJEMEN PRODUK
    // =========================================================================

    public function productsIndex()
    {
        $products = Product::latest()->paginate(10); // Menggunakan paginasi
        return view('admin.products.index', compact('products'));
    }

    public function productsCreate()
    {
        return view('admin.products.create');
    }

    public function productsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $path = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $path,
            // Jika Anda sudah mengimplementasikan relasi, tambahkan ini:
            // 'admin_id' => auth()->guard('admin')->id(),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    public function productsEdit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function productsUpdate(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Gambar tidak wajib diubah
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function productsDestroy(Product $product)
    {
        // Hapus gambar dari storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }


    // =========================================================================
    // MANAJEMEN PESANAN
    // =========================================================================

    public function ordersIndex()
    {
        $orders = Order::with('user')->latest()->paginate(10); // Mengambil relasi user jika ada
        return view('admin.orders.index', compact('orders'));
    }

    public function reviewOrder(Order $order)
    {
        return view('admin.orders.review', compact('order'));
    }

    public function confirmOrder(Order $order)
    {
        // Ubah status order menjadi 'shipped' (dikirim)
        $order->update([
            'status' => 'shipped',
            // Jika Anda sudah implementasi relasi, tambahkan ini:
            // 'processed_by_admin_id' => auth()->guard('admin')->id(),
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan #' . $order->id . ' berhasil dikonfirmasi dan ditandai sebagai "Dikirim".');
    }

    public function cancelOrder(Order $order)
    {
        // Di sini Anda bisa menambahkan logika untuk mengembalikan stok produk jika perlu

        // Ubah status order menjadi 'cancelled'
        $order->update(['status' => 'cancelled']);

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan #' . $order->id . ' berhasil dibatalkan.');
    }
}