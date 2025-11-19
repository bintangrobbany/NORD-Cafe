<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - NORD CAFE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <a href="{{ url('/') }}" class="inline-block transition-transform hover:scale-105">
                <img src="{{ asset('LOGO_PRIMER.png') }}" alt="Logo Brown Bean Coffee" class="h-24 mx-auto mb-4">
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Formulir Checkout</h1>
            <p class="text-gray-500 mt-2">Selesaikan pesanan Anda dengan mengisi detail di bawah ini.</p>
        </div>

        @if(session('error'))
            <div class="max-w-4xl mx-auto bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg"
                role="alert">
                <p class="font-bold">Error</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="max-w-4xl mx-auto bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg"
                role="alert">
                <p class="font-bold">Harap perbaiki error berikut:</p>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.placeOrder') }}" method="POST" enctype="multipart/form-data"
            class="max-w-4xl mx-auto">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <!-- Kolom Kiri: Form & Pembayaran -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-xl font-semibold mb-6 border-b pb-4">1. Detail Kontak</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                placeholder="Contoh: 08123456789" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                            <textarea id="address" name="address" rows="3"
                                placeholder="Contoh: Jl. Kopi No. 123, Kel. Suka Ngopi, Kec. Sejahtera, Kota Bahagia"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-amber-500 focus:border-amber-500">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <h2 class="text-xl font-semibold mt-8 mb-6 border-b pb-4">2. Metode Pembayaran</h2>
                    <div id="payment-methods" class="space-y-4">
                        <label
                            class="flex items-center p-4 border rounded-lg has-[:checked]:bg-amber-50 has-[:checked]:border-amber-500 transition cursor-pointer"><input
                                type="radio" name="payment_method" value="BCA"
                                class="h-5 w-5 text-amber-600 focus:ring-amber-500" required><span
                                class="ml-3 font-medium text-gray-700">Bank BCA</span></label>
                        <label
                            class="flex items-center p-4 border rounded-lg has-[:checked]:bg-amber-50 has-[:checked]:border-amber-500 transition cursor-pointer"><input
                                type="radio" name="payment_method" value="BRI"
                                class="h-5 w-5 text-amber-600 focus:ring-amber-500"><span
                                class="ml-3 font-medium text-gray-700">Bank BRI</span></label>
                        <label
                            class="flex items-center p-4 border rounded-lg has-[:checked]:bg-amber-50 has-[:checked]:border-amber-500 transition cursor-pointer"><input
                                type="radio" name="payment_method" value="BNI"
                                class="h-5 w-5 text-amber-600 focus:ring-amber-500"><span
                                class="ml-3 font-medium text-gray-700">Bank BNI</span></label>
                        <label
                            class="flex items-center p-4 border rounded-lg has-[:checked]:bg-amber-50 has-[:checked]:border-amber-500 transition cursor-pointer"><input
                                type="radio" name="payment_method" value="Dana"
                                class="h-5 w-5 text-amber-600 focus:ring-amber-500"><span
                                class="ml-3 font-medium text-gray-700">Dana</span></label>
                    </div>

                    <div id="payment-details" class="mt-6 p-4 bg-gray-50 rounded-lg hidden">
                        <p class="text-sm text-gray-600">Silakan transfer ke nomor berikut:</p>
                        <p id="payment-info" class="text-lg font-bold text-gray-800 tracking-wider mt-2"></p>
                    </div>

                    <h2 class="text-xl font-semibold mt-8 mb-6 border-b pb-4">3. Upload Bukti Pembayaran</h2>
                    <div>
                        <label for="payment_proof" class="block text-sm font-medium text-gray-700">File Bukti Transfer
                            (JPG, PNG)</label>
                        <input type="file" id="payment_proof" name="payment_proof" required
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                    </div>
                </div>

                <!-- Kolom Kanan: Ringkasan Pesanan -->
                <div class="bg-white p-8 rounded-xl shadow-lg h-fit sticky top-8">
                    <h2 class="text-xl font-semibold mb-6 border-b pb-4">Ringkasan Pesanan</h2>
                    <div id="order-summary" class="space-y-4">
                        <!-- Item akan di-generate oleh JavaScript -->
                    </div>
                    <div class="border-t mt-6 pt-4">
                        <div class="flex justify-between font-semibold text-lg">
                            <span>Total</span>
                            <span id="summary-total">Rp 0</span>
                        </div>
                    </div>
                    <!-- Hidden input untuk mengirim data keranjang ke backend -->
                    <input type="hidden" name="cart" id="cart-input">
                    <button type="submit"
                        class="w-full mt-8 bg-amber-700 text-white py-3 rounded-lg font-semibold hover:bg-amber-800 transition transform hover:scale-105">
                        <i class="fas fa-shield-alt mr-2"></i> Buat Pesanan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        const userId = localStorage.getItem('user_id') || 'guest';
        const CART_KEY = `cart_${userId}`;
        const cart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
        const orderSummary = document.getElementById('order-summary');
        const summaryTotal = document.getElementById('summary-total');
        const cartInput = document.getElementById('cart-input');
        let total = 0;
        if (cart.length > 0) {
            cart.forEach(item => { total += item.price * item.qty; orderSummary.innerHTML += `<div class="flex justify-between items-center text-sm"><div><p class="font-medium text-gray-800">${item.name}</p><p class="text-gray-500">Jumlah: ${item.qty}</p></div><p class="text-gray-600">Rp ${(item.price * item.qty).toLocaleString()}</p></div>`; });
            summaryTotal.textContent = 'Rp ' + total.toLocaleString();
            cartInput.value = JSON.stringify(cart);
        } else {
            orderSummary.innerHTML = '<p class="text-center text-gray-500">Keranjang Anda kosong. Silakan kembali untuk berbelanja.</p>';
            const submitButton = document.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Keranjang Kosong';
            submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            submitButton.classList.remove('bg-amber-700', 'hover:bg-amber-800');
        }
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const paymentDetails = document.getElementById('payment-details');
        const paymentInfo = document.getElementById('payment-info');
        const accountData = { BCA: '123-456-7890 (a.n. Brown Bean Coffee)', BRI: '098-765-4321 (a.n. Brown Bean Coffee)', BNI: '555-666-7777 (a.n. Brown Bean Coffee)', Dana: '0812-3456-7890 (a.n. Brown Bean Coffee)' };
        paymentMethods.forEach(radio => { radio.addEventListener('change', function () { if (this.checked) { paymentInfo.textContent = accountData[this.value]; paymentDetails.classList.remove('hidden'); } }); });
    </script>
</body>

</html>