<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Brown Bean Coffee</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-12 relative">
        <a href="{{ route('index') }}"
            class="absolute top-12 left-4 sm:left-8 flex items-center text-gray-600 hover:text-amber-700 font-semibold transition-colors"><i
                class="fas fa-arrow-left mr-2"></i> Kembali ke Toko</a>
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10 pt-12">
                <a href="{{ url('/') }}" class="inline-block transition-transform hover:scale-105"><img
                        src="{{ asset('LOGO_PRIMER.png') }}" alt="Logo Brown Bean Coffee" class="h-24 mx-auto mb-4"></a>
                <h1 class="text-3xl font-bold text-gray-800">Riwayat Pesanan Saya</h1>
                <p class="text-gray-500 mt-2">Klik pada setiap pesanan untuk melihat detail struk dan statusnya.</p>
            </div>

            <!-- Menampilkan Notifikasi Sukses/Error -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="space-y-4">
                @forelse ($orders as $order)
                    <!-- Kartu Pesanan Individual (Accordion Item) -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-shadow hover:shadow-2xl">

                        <!-- Header Pesanan (Yang bisa di-klik) -->
                        <button
                            class="toggle-details w-full p-6 text-left flex items-center justify-between hover:bg-gray-50 focus:outline-none focus:bg-gray-100 transition">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 flex-1">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">ID Pesanan</p>
                                    <p class="font-semibold text-gray-800">#{{ $order->id }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Tanggal</p>
                                    <p class="font-semibold text-gray-800">{{ $order->created_at->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Total</p>
                                    <p class="font-semibold text-gray-800">Rp
                                        {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Status</p>
                                    <div class="flex flex-col items-start">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                                @if($order->status == 'completed' || $order->status == 'paid') bg-green-200 text-green-800 
                                                @elseif($order->status == 'shipped') bg-blue-200 text-blue-800
                                                @elseif($order->status == 'cancelled') bg-red-200 text-red-800
                                                @else bg-yellow-200 text-yellow-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        @if($order->status == 'shipped')
                                            <!-- Tombol "Pesanan Diterima" yang diperbarui -->
                                            <form action="{{ route('orders.complete', $order) }}" method="POST"
                                                class="complete-order-form mt-2">
                                                @csrf
                                                <button type="submit"
                                                    class="text-xs bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 font-semibold transition flex items-center gap-2">
                                                    <i class="fas fa-check-circle"></i> Pesanan Diterima
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform ml-4"></i>
                        </button>

                        <!-- Detail Struk (Tersembunyi) -->
                        <div class="order-details hidden bg-gray-50 p-6 sm:p-8 border-t border-gray-200">
                            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                                <div class="lg:col-span-2 space-y-6">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-2">Total Pembayaran</h3>
                                        <p class="text-2xl font-bold text-amber-700">Rp
                                            {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h3 class="font-semibold text-gray-800 mb-2">Tanggal Transaksi</h3>
                                        <p class="text-sm text-gray-600">{{ $order->created_at->format('d F Y, H:i:s') }}
                                        </p>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h3 class="font-semibold text-gray-800 mb-2">Rincian Pengiriman</h3>
                                        <div class="text-sm text-gray-600 space-y-1">
                                            <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
                                            <p><strong>Telepon:</strong> {{ $order->customer_phone }}</p>
                                            <p><strong>Alamat:</strong> {{ $order->address }}</p>
                                        </div>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h3 class="font-semibold text-gray-800 mb-2">Metode Pembayaran</h3>
                                        <p class="text-sm font-bold text-gray-700">{{ $order->payment_method }}</p>
                                    </div>
                                </div>
                                <div class="lg:col-span-3">
                                    <h3 class="font-semibold text-gray-800 mb-2">Rincian Pesanan</h3>
                                    <div class="border rounded-lg overflow-hidden">
                                        <table class="w-full text-sm">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-left font-semibold p-2">Produk</th>
                                                    <th class="text-center font-semibold p-2">Jumlah</th>
                                                    <th class="text-right font-semibold p-2">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->items as $item)
                                                    <tr class="border-b">
                                                        <td class="p-2">{{ $item->product_name }}</td>
                                                        <td class="text-center p-2">x {{ $item->quantity }}</td>
                                                        <td class="text-right p-2">Rp
                                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($order->payment_proof)
                                        <div class="mt-6">
                                            <h3 class="font-semibold text-gray-800 mb-2">Bukti Pembayaran</h3><a
                                                href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank"
                                                title="Lihat gambar ukuran penuh"><img
                                                    src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran"
                                                    class="rounded-lg border w-full max-w-sm cursor-pointer hover:opacity-80 transition"></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 px-6 bg-white rounded-lg shadow-md"><i
                            class="fas fa-box-open text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500 text-lg">Anda belum memiliki riwayat pesanan.</p><a
                            href="{{ route('index') }}#katalog"
                            class="mt-4 inline-block bg-amber-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-amber-700 transition">Mulai
                            Belanja Sekarang</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-details').forEach(button => {
            button.addEventListener('click', () => {
                const details = button.nextElementSibling;
                const icon = button.querySelector('i');
                document.querySelectorAll('.order-details').forEach(otherDetail => {
                    if (otherDetail !== details) {
                        otherDetail.classList.add('hidden');
                        otherDetail.previousElementSibling.querySelector('i').classList.remove('rotate-180');
                    }
                });
                details.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });

        document.querySelectorAll('.complete-order-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi Penerimaan?',
                    text: "Apakah Anda yakin sudah menerima pesanan ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#16a34a',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Sudah Diterima!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });
        });
    </script>
</body>

</html>