<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Brown Bean Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 sm:p-10 rounded-xl shadow-lg text-center max-w-lg mx-auto">
        <!-- Ikon Sukses -->
        <div class="mx-auto mb-6 h-20 w-20 flex items-center justify-center rounded-full bg-green-100">
            <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <!-- Judul -->
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Terima Kasih!</h1>

        <!-- Pesan Dinamis dari Controller -->
        @if(session('success'))
            <p class="text-gray-600 mb-8">{{ session('success') }}</p>
        @else
            <p class="text-gray-600 mb-8">Pesanan Anda telah berhasil dibuat dan sedang menunggu verifikasi oleh admin kami.
            </p>
        @endif

        <!-- Tombol Aksi -->
        <div class="space-y-4">
            <a href="{{ route('index') }}"
                class="w-full block bg-amber-700 text-white py-3 rounded-lg font-semibold hover:bg-amber-800 transition">
                Kembali ke Halaman Utama
            </a>
            <a href="{{ route('orders.history') }}"
                class="w-full block bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                Lihat Riwayat Pesanan Saya
            </a>
        </div>
    </div>

    <!-- [BARU] Script untuk Mengosongkan Keranjang -->
    <script>
        // Jalankan script ini saat halaman "sukses" dimuat
        document.addEventListener('DOMContentLoaded', (event) => {
            // Dapatkan user ID dari localStorage (jika ada)
            const userId = localStorage.getItem('user_id');
            if (userId) {
                const CART_KEY = `cart_${userId}`;
                // Hapus data keranjang dari localStorage
                localStorage.removeItem(CART_KEY);
                console.log('Keranjang untuk user ' + userId + ' telah dikosongkan.');
            }
        });
    </script>

</body>

</html>