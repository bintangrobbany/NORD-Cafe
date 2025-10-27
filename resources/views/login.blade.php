<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Brown Bean Coffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200" style="font-family: 'Poppins', sans-serif;">
    <div class="fixed inset-0 w-full h-full bg-cover bg-center -z-10" style="background-image: url('https://images.unsplash.com/photo-1559925393-8be0ec4767c8?auto=format&fit=crop&w=1470&q=80');"></div>
    <div class="fixed inset-0 w-full h-full bg-black/60 -z-10"></div>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div id="login-card" class="relative bg-white/90 backdrop-blur-lg p-8 sm:p-10 rounded-2xl shadow-xl w-full max-w-md opacity-0 scale-95 transition-all duration-500 ease-out">
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-block mb-4">
                    <img src="{{ asset('LOGO_PRIMER.png') }}" alt="Logo Brown Bean Coffee" class="h-24 mx-auto">
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali!</h1>
                <p class="text-sm text-gray-500">Silakan masuk untuk melanjutkan pesanan Anda.</p>
            </div>
            
            @if (session('error'))
                <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 border-l-4 border-red-500 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 border-l-4 border-green-500 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulir Login -->
            <form class="space-y-5" method="post" action="{{ route('postlogin') }}">
                @csrf

                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="email" name="email" placeholder="Email Anda" required
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none transition" />
                </div>

                <!-- Input Password dengan Ikon dan Tombol Show/Hide -->
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required
                        class="w-full pl-12 pr-12 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none transition" />
                    <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <i id="eye-icon" class="fa-solid fa-eye"></i>
                    </button>
                </div>


                <div class="text-right">
                    <a href="#" class="text-sm text-amber-700 hover:underline">Lupa Password?</a>
                </div>
                <button type="submit"
                    class="w-full py-3 bg-amber-700 text-white rounded-lg font-semibold hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 transition duration-300 transform hover:scale-105">
                    Login
                </button>
            </form>
            <p class="text-center text-sm text-gray-600 mt-8">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-amber-700 hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>


    <script>
        // Script untuk animasi kartu login saat halaman dimuat
        window.addEventListener('load', () => {
            const loginCard = document.getElementById('login-card');
            loginCard.classList.remove('opacity-0', 'scale-95');
        });

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    </script>
</body>
</html>