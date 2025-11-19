@extends('layouts.admin')

@section('title', 'Review Pesanan #' . $order->id)

@section('content')

    <head>
        <!-- Tambahkan SweetAlert2 Library di head -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <div class="bg-white p-8 rounded-xl shadow-lg max-w-4xl mx-auto">
        <div class="flex justify-between items-start mb-6 border-b pb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Detail Pesanan <span
                        class="text-amber-600">#{{ $order->id }}</span></h2>
                <p class="text-sm text-gray-500">Dipesan pada: {{ $order->created_at->format('d F Y, H:i') }}</p>
            </div>
            <span
                class="px-4 py-1 text-sm font-semibold rounded-full bg-yellow-200 text-yellow-800">{{ ucfirst($order->status) }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Kiri: Info Pelanggan & Pembayaran -->
            <div>
                <h3 class="font-semibold text-lg mb-4 text-gray-700">Informasi Pelanggan</h3>
                <div class="space-y-2 text-sm">
                    <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                    <p><strong>Telepon:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Alamat:</strong> {{ $order->address }}</p>
                </div>

                <h3 class="font-semibold text-lg mt-8 mb-4 text-gray-700">Bukti Pembayaran</h3>
                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank">
                    <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran"
                        class="rounded-lg border w-full max-w-xs hover:opacity-80 transition">
                </a>
            </div>

            <!-- Kolom Kanan: Rincian Pesanan -->
            <div>
                <h3 class="font-semibold text-lg mb-4 text-gray-700">Rincian Item</h3>
                <div class="border rounded-lg">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="p-3 text-left font-semibold">Produk</th>
                                <th class="p-3 text-center font-semibold">Jumlah</th>
                                <th class="p-3 text-right font-semibold">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr class="border-b">
                                    <td class="p-3">{{ $item->product_name }}</td>
                                    <td class="p-3 text-center">x {{ $item->quantity }}</td>
                                    <td class="p-3 text-right">Rp
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr class="font-bold bg-gray-50">
                                <td colspan="2" class="p-3 text-right">Total:</td>
                                <td class="p-3 text-right text-base text-amber-700">Rp
                                    {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tombol Aksi Admin -->
                @if($order->status == 'pending')
                    <div class="mt-8 flex justify-end gap-4">
                        <form id="cancel-form" action="{{ route('admin.orders.cancel', $order) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-6 py-2 border rounded-lg text-red-600 hover:bg-red-50 font-semibold">Batalkan
                                Pesanan</button>
                        </form>
                        <form id="confirm-form" action="{{ route('admin.orders.confirm', $order) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">Konfirmasi
                                & Kirim</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- [PERUBAHAN DI SINI] Script untuk SweetAlert -->
    <script>
        const confirmForm = document.getElementById('confirm-form');
        if (confirmForm) {
            confirmForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah form submit secara langsung
                Swal.fire({
                    title: 'Konfirmasi Pesanan?',
                    text: "Anda akan mengubah status pesanan menjadi 'Dikirim'. Tindakan ini tidak dapat dibatalkan.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#16a34a', // green-600
                    cancelButtonColor: '#6b7280', // gray-500
                    confirmButtonText: 'Ya, Konfirmasi & Kirim!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Jika dikonfirmasi, kirim form
                    }
                })
            });
        }

        const cancelForm = document.getElementById('cancel-form');
        if (cancelForm) {
            cancelForm.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Batalkan Pesanan?',
                    text: "Stok produk akan dikembalikan. Tindakan ini tidak dapat dibatalkan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626', // red-600
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Batalkan Pesanan!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });
        }
    </script>
@endsection