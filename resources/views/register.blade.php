<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Brown Bean Coffee</title>
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
        <div id="register-card" class="relative bg-white/90 backdrop-blur-lg p-8 sm:p-10 rounded-2xl shadow-xl w-full max-w-md opacity-0 scale-95 transition-all duration-500 ease-out">
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-block mb-4">
                    <img src="{{ asset('LOGO_PRIMER.png') }}" alt="Logo Brown Bean Coffee" class="h-24 mx-auto">
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h1>
                <p class="text-sm text-gray-500">Hanya butuh beberapa detik untuk bergabung.</p>
            </div>
            
            
            @if ($errors->any())
                <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 border-l-4 border-red-500 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulir Register -->
            <form id="registerForm" class="space-y-5" method="post" action="{{ route('postregister') }}">
                @csrf

                <div class="relative">
                    <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="nama" placeholder="Nama Lengkap Anda" required value="{{ old('nama') }}"
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none transition" />
                </div>

                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="email" name="email" placeholder="Email Anda" required value="{{ old('email') }}"
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none transition" />
                </div>

                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="password" id="password" name="password" placeholder="Buat Password" required
                        class="w-full pl-12 pr-12 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none transition" />
                    <button type="button" class="togglePassword absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <i class="eye-icon fa-solid fa-eye"></i>
                    </button>
                </div>

                
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Konfirmasi Password" required
                        class="w-full pl-12 pr-12 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none transition" />
                    <button type="button" class="togglePassword absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <i class="eye-icon fa-solid fa-eye"></i>
                    </button>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-amber-700 text-white rounded-lg font-semibold hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 transition duration-300 transform hover:scale-105">
                    Daftar
                </button>
            </form>

            <!-- Link ke Halaman Login -->
            <p class="text-center text-sm text-gray-600 mt-8">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-amber-700 hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            const registerCard = document.getElementById('register-card');
            registerCard.classList.remove('opacity-0', 'scale-95');
        });

        // Script untuk toggle show/hide SEMUA input password
        const togglePasswordButtons = document.querySelectorAll('.togglePassword');
        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function() {
                const passwordInput = this.previousElementSibling; // Input berada sebelum tombol
                const eyeIcon = this.querySelector('.eye-icon');
                
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });
        });

        // Script untuk validasi kecocokan password sebelum submit
        const form = document.getElementById('registerForm');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');

        form.addEventListener('submit', function(e) {
            if (password.value !== confirmPassword.value) {
                e.preventDefault(); 
                alert('Konfirmasi password tidak cocok! Silakan periksa kembali.');
                password.classList.add('border-red-500');
                confirmPassword.classList.add('border-red-500');
            }
        });
    </script>
</body>
</html>