<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderController extends Controller
{
    public function checkoutPage()
    {
        return view('checkout');
    }

    public function placeOrder(Request $request)
    {
        $validatedData = $request->validate(['name' => 'required|string|max:255', 'email' => 'required|email|max:255', 'phone' => 'required|string|max:20', 'address' => 'required|string', 'payment_method' => 'required|string', 'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 'cart' => 'required|json',]);
        $cartItems = json_decode($validatedData['cart'], true);
        if (empty($cartItems)) {
            return back()->with('error', 'Keranjang Anda kosong.');
        }

        DB::beginTransaction();
        try {
            $totalPrice = 0;
            $productsToUpdate = [];
            $orderItemsData = [];

            foreach ($cartItems as $item) {
                $product = Product::where('id', $item['id'])->lockForUpdate()->first();
                if (!$product || $product->stock < $item['qty']) {
                    throw new \Exception('Stok untuk produk "' . ($product->name ?? 'Tidak Dikenal') . '" tidak mencukupi.');
                }

                $totalPrice += $product->price * $item['qty'];
                $productsToUpdate[] = ['product' => $product, 'quantity' => $item['qty']];

                $orderItemsData[] = ['product_id' => $product->id, 'product_name' => $product->name, 'quantity' => $item['qty'], 'price' => $product->price];
            }

            $paymentProofPath = $request->file('payment_proof')->store('proofs', 'public');

            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $validatedData['name'],
                'customer_email' => $validatedData['email'],
                'customer_phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'payment_method' => $validatedData['payment_method'],
                'total_price' => $totalPrice,
                'status' => 'pending',
                'payment_proof' => $paymentProofPath,
            ]);

            $order->items()->createMany($orderItemsData);

            foreach ($productsToUpdate as $data) {
                $data['product']->decrement('stock', $data['quantity']);
            }

            DB::commit();
            return redirect()->route('checkout.success')->with('success', 'Pesanan Anda dengan ID #' . $order->id . ' telah berhasil dibuat dan sedang menunggu verifikasi.');

        } catch (Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan halaman riwayat pesanan milik pengguna.
     */
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items')
            ->latest()
            ->paginate(5);

        return view('riwayat-pesanan', compact('orders'));
    }

    /**
     * [BARU] Mengubah status pesanan menjadi "completed" oleh pengguna.
     */
    public function markAsCompleted(Order $order)
    {
        // Keamanan: Pastikan pengguna hanya bisa mengubah status pesanannya sendiri
        if (Auth::id() !== $order->user_id) {
            abort(403, 'AKSES DITOLAK');
        }

        // Hanya ubah status jika pesanan memang sedang dalam status "dikirim"
        if ($order->status == 'shipped') {
            $order->status = 'completed';
            $order->save();

            return back()->with('success', 'Terima kasih telah mengonfirmasi! Pesanan #' . $order->id . ' telah selesai.');
        }

        return back()->with('error', 'Status pesanan ini tidak dapat diubah.');
    }
}