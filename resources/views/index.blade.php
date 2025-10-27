<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Brown Bean Coffee - Nikmati Kepenatan dengan Secangkir Kopi</title>

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Style untuk Smooth Scrolling -->
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800" style="font-family: 'Poppins', sans-serif;">

    <!-- Navbar Dinamis -->
    <nav id="navbar" class="bg-transparent backdrop-blur-md fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">

                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('LOGO_PRIMER.png') }}" alt="Logo Brown Bean Coffee" style="height: 5pc;">
                </div>

                <!-- Menu -->
                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="hover:text-amber-600 font-medium">Home</a>
                    <a href="#about" class="hover:text-amber-600 font-medium">About</a>
                    <a href="#katalog" class="hover:text-amber-600 font-medium">Katalog</a>
                    <a href="#contact" class="hover:text-amber-600 font-medium">Contact</a>
                </div>

                <!-- [BARU] Menampilkan Nama Pengguna & Tombol Logout -->
                <div class="hidden md:flex items-center gap-5">
                    @auth
                        <span class="font-medium text-gray-700">Halo, {{ Auth::user()->name }}</span>

                        <button id="cart-btn" class="relative">
                            <i class="fas fa-shopping-cart text-2xl text-gray-700 hover:text-amber-600 transition"></i>
                            <span id="cart-count"
                                class="absolute -top-2 -right-3 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                        </button>

                        <a href="{{ route('logout') }}" title="Logout" class="text-gray-600 hover:text-red-600 transition">
                            <i class="fa-solid fa-right-from-bracket text-xl"></i>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden"><i
                        class="fas fa-bars text-xl text-gray-700"></i></button>
            </div>
        </div>
        <div id="mobile-menu" class="md:hidden hidden bg-white/95 border-t border-gray-200">
            <div class="px-4 py-4 space-y-2">
                <a href="#home" class="block py-2 hover:text-amber-600">Home</a>
                <a href="#about" class="block py-2 hover:text-amber-600">About</a>
                <a href="#katalog" class="block py-2 hover:text-amber-600">Katalog</a>
                <a href="#contact" class="block py-2 hover:text-amber-600">Contact</a>
                @auth
                    <div class="border-t pt-4 mt-2">
                        <p class="font-medium text-gray-800 mb-2">Halo, {{ Auth::user()->name }}</p>
                        <a href="{{ route('logout') }}"
                            class="block text-center bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-full font-semibold transition">
                            Logout
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center text-white pt-16"
        style="background: linear-gradient(rgba(20, 10, 5, 0.55), rgba(20,10,5,0.55)), url('https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat; background-attachment: fixed;">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div id="hero-content"
                class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 md:p-12 inline-block opacity-0 translate-y-4 transition-all duration-1000 ease-out">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Brown Bean Coffee — <span class="text-amber-300">Nikmati
                        Setiap Teguk</span></h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto">Kopi spesial, roti panggang segar, dan
                    suasana hangat — tempat ngopi favoritmu.</p>
                <a href="#katalog"
                    class="bg-amber-600 hover:bg-amber-700 px-8 py-4 rounded-full text-lg font-semibold transform hover:scale-105 transition"><i
                        class="fas fa-mug-saucer mr-2"></i>Lihat Menu</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-amber-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6 bg-amber-700 rounded-xl shadow text-white"><i
                        class="fas fa-mug-saucer text-3xl mb-3"></i>
                    <h3 class="text-2xl font-bold">12000+</h3>
                    <p>Cangkir Terhidang</p>
                </div>
                <div class="p-6 bg-amber-700 rounded-xl shadow text-white"><i class="fas fa-users text-3xl mb-3"></i>
                    <h3 class="text-2xl font-bold">20+</h3>
                    <p>Barista Profesional</p>
                </div>
                <div class="p-6 bg-amber-700 rounded-xl shadow text-white"><i class="fas fa-coffee text-3xl mb-3"></i>
                    <h3 class="text-2xl font-bold">10</h3>
                    <p>Tahun Roastery</p>
                </div>
                <div class="p-6 bg-amber-700 rounded-xl shadow text-white"><i class="fas fa-star text-3xl mb-3"></i>
                    <h3 class="text-2xl font-bold">4.8/5</h3>
                    <p>Rating Pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-20"><span class="text-amber-600 font-semibold tracking-wide">ABOUT US</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Kenapa Pilih Brown Bean Coffee?</h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">Kami menyajikan kopi spesial dari biji
                    pilihan, dipanggang dan diracik oleh barista ahli.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="relative group"><img src="https://placehold.co/600x400/362415/FFFFFF?text=Warung+Kopi"
                        alt="Barista membuat kopi" class="rounded-3xl shadow-2xl w-full h-full object-cover"></div>
                <div class="space-y-8">
                    <h3 class="text-3xl font-semibold text-gray-900">Kualitas & Suasana</h3>
                    <p class="text-gray-600 text-lg">Dari single-origin hingga espresso blends, kami menyajikan berbagai
                        varian dengan perhatian penuh.</p>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="flex items-start">
                            <div class="bg-amber-100 p-4 rounded-full mr-4 shadow-md"><i
                                    class="fas fa-seedling text-amber-600 text-lg"></i></div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Biji Pilihan</h4>
                                <p class="text-sm text-gray-600">Kerjasama petani lokal & impor.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-amber-100 p-4 rounded-full mr-4 shadow-md"><i
                                    class="fas fa-heart text-amber-600 text-lg"></i></div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Perhatian Penuh</h4>
                                <p class="text-sm text-gray-600">Setiap cangkir dibuat dengan cinta.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-amber-100 p-4 rounded-full mr-4 shadow-md"><i
                                    class="fas fa-award text-amber-600 text-lg"></i></div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Barista Bersertifikat</h4>
                                <p class="text-sm text-gray-600">Keahlian seduh profesional.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-amber-100 p-4 rounded-full mr-4 shadow-md"><i
                                    class="fas fa-clock text-amber-600 text-lg"></i></div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Jam Nyaman</h4>
                                <p class="text-sm text-gray-600">Buka setiap hari untuk menemanimu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Katalog Produk -->
    <section id="katalog" class="py-20 flex justify-center bg-gray-50">
        <div class="w-[90%] md:w-[85%] rounded-3xl shadow-lg text-center text-white py-16 px-6 md:px-20"
            style="background: linear-gradient(90deg, #9b4800 0%, #b95e0d 100%);">
            <h2 class="text-3xl font-bold mb-10 text-white">Katalog Produk Kami</h2>
            <div class="grid md:grid-cols-4 sm:grid-cols-2 gap-8">
                <div
                    class="group bg-white rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 p-4 text-gray-800 flex flex-col">
                    <div class="rounded-lg mb-4 w-full h-48 overflow-hidden"><img src="{{ asset('LOGO_PRIMER.png') }}"
                            alt="Arabica Beans"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold text-xl mb-2">Arabica Beans 250g</h3>
                        <p class="text-gray-600 mb-2">Biji kopi premium 100% Arabica.</p>
                    </div><span class="font-bold text-[#3b2f2f] block my-2">Rp 85.000</span><button
                        class="add-to-cart mt-auto bg-[#6b3e26] text-white px-3 py-2 rounded-lg hover:bg-[#4e2c1a] transition-colors"
                        data-name="Arabica Beans 250g" data-price="85000">Tambah ke Keranjang</button>
                </div>
                <div
                    class="group bg-white rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 p-4 text-gray-800 flex flex-col">
                    <div class="rounded-lg mb-4 w-full h-48 overflow-hidden"><img src="{{ asset('LOGO_PRIMER.png') }}"
                            alt="Cold Brew Bottle"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold text-xl mb-2">Cold Brew Bottle</h3>
                        <p class="text-gray-600 mb-2">Minuman kopi siap saji segar.</p>
                    </div><span class="font-bold text-[#3b2f2f] block my-2">Rp 30.000</span><button
                        class="add-to-cart mt-auto bg-[#6b3e26] text-white px-3 py-2 rounded-lg hover:bg-[#4e2c1a] transition-colors"
                        data-name="Cold Brew Bottle" data-price="30000">Tambah ke Keranjang</button>
                </div>
                <div
                    class="group bg-white rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 p-4 text-gray-800 flex flex-col">
                    <div class="rounded-lg mb-4 w-full h-48 overflow-hidden"><img src="{{ asset('LOGO_PRIMER.png') }}"
                            alt="Brownies Coffee"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold text-xl mb-2">Brownies Coffee</h3>
                        <p class="text-gray-600 mb-2">Brownies lembut dengan aroma kopi.</p>
                    </div><span class="font-bold text-[#3b2f2f] block my-2">Rp 22.000</span><button
                        class="add-to-cart mt-auto bg-[#6b3e26] text-white px-3 py-2 rounded-lg hover:bg-[#4e2c1a] transition-colors"
                        data-name="Brownies Coffee" data-price="22000">Tambah ke Keranjang</button>
                </div>
                <div
                    class="group bg-white rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 p-4 text-gray-800 flex flex-col">
                    <div class="rounded-lg mb-4 w-full h-48 overflow-hidden"><img src="{{ asset('LOGO_PRIMER.png') }}"
                            alt="Coffee Drip Set"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold text-xl mb-2">Coffee Drip Set</h3>
                        <p class="text-gray-600 mb-2">Paket alat seduh kopi manual.</p>
                    </div><span class="font-bold text-[#3b2f2f] block my-2">Rp 250.000</span><button
                        class="add-to-cart mt-auto bg-[#6b3e26] text-white px-3 py-2 rounded-lg hover:bg-[#4e2c1a] transition-colors"
                        data-name="Coffee Drip Set" data-price="250000">Tambah ke Keranjang</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16"><span class="text-amber-600 font-semibold">CONTACT US</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Hubungi & Kunjungi Kami</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Ingin reservasi meja atau tanya menu? Kami siap
                    membantu.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-12">
                <form class="space-y-6 bg-gray-50 p-8 rounded-2xl shadow-md"><input type="text"
                        placeholder="Masukkan Nama Anda"
                        class="w-full p-4 rounded-lg border focus:ring-2 focus:ring-amber-600"><input type="email"
                        placeholder="Masukkan Email Anda"
                        class="w-full p-4 rounded-lg border focus:ring-2 focus:ring-amber-600"><input type="tel"
                        placeholder="Masukkan Nomor Anda"
                        class="w-full p-4 rounded-lg border focus:ring-2 focus:ring-amber-600"><textarea
                        placeholder="Pesan / Reservasi"
                        class="w-full p-4 rounded-lg border focus:ring-2 focus:ring-amber-600 h-32"></textarea><button
                        type="submit"
                        class="w-full bg-amber-600 hover:bg-amber-700 text-white px-6 py-4 rounded-full font-semibold transition">Kirim
                        Pesan</button></form>
                <div class="space-y-8">
                    <div class="flex items-start"><i
                            class="fas fa-map-marker-alt text-3xl text-amber-600 mr-4 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-lg">Lokasi Kami</h4>
                            <p class="text-gray-600">Jalan Raya Tlogomas No 246, Kecamatan Lowokwaru, Kota Malang, Jawa
                                Timur</p>
                        </div>
                    </div>
                    <div class="flex items-start"><i class="fas fa-phone text-3xl text-amber-600 mr-4 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-lg">Nomor Kami</h4>
                            <p class="text-gray-600">0000000</p>
                        </div>
                    </div>
                    <div class="flex items-start"><i class="fas fa-envelope text-3xl text-amber-600 mr-4 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-lg">Email Kami</h4>
                            <p class="text-gray-600">info@brownbreancoffee.id</p>
                        </div>
                    </div>
                    <div class="mt-6"><iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63225.82751122264!2d112.35440199624021!3d-7.935297565692228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78892aa33e5a5f%3A0xc10d394b2219d5bb!2sBalai%20Desa%20Pagersari%2C%20Ngantang%2C%20Malang!5e0!3m2!1sid!2sid!4v1760711407254!5m2!1sid!2sid"
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" class="rounded-xl"></iframe></div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs Section -->
    <section id="faqs" class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4">
            <div class="text-center mb-16"><span class="text-amber-600 font-semibold">FAQs</span>
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Punya pertanyaan tentang menu, reservasi, atau acara?
                    Berikut beberapa hal yang sering ditanyakan.</p>
            </div>
            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-md overflow-hidden"><button
                        class="w-full flex justify-between items-center px-6 py-4 text-left font-semibold text-gray-800 hover:bg-amber-50 transition faq-toggle"><span>Jam
                            operasional ?</span><i
                            class="fas fa-chevron-down text-gray-500 transition-transform"></i></button>
                    <div class="px-6 pb-4 text-gray-600 hidden">Kami buka setiap hari, pukul 07.00 – 22.00 WIB. Untuk
                        acara khusus, cek pengumuman di media sosial.</div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden"><button
                        class="w-full flex justify-between items-center px-6 py-4 text-left font-semibold text-gray-800 hover:bg-amber-50 transition faq-toggle"><span>Apakah
                            menerima reservasi?</span><i
                            class="fas fa-chevron-down text-gray-500 transition-transform"></i></button>
                    <div class="px-6 pb-4 text-gray-600 hidden">Ya, bisa reservasi meja via form kontak di halaman
                        Contact atau telepon langsung.</div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden"><button
                        class="w-full flex justify-between items-center px-6 py-4 text-left font-semibold text-gray-800 hover:bg-amber-50 transition faq-toggle"><span>Ada
                            pilihan non-kopi?</span><i
                            class="fas fa-chevron-down text-gray-500 transition-transform"></i></button>
                    <div class="px-6 pb-4 text-gray-600 hidden">Tentu — kami menyajikan teh, minuman cokelat, susu, dan
                        camilan untuk semua selera.</div>
                </div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden"><button
                        class="w-full flex justify-between items-center px-6 py-4 text-left font-semibold text-gray-800 hover:bg-amber-50 transition faq-toggle"><span>Apakah
                            ada layanan acara/private?</span><i
                            class="fas fa-chevron-down text-gray-500 transition-transform"></i></button>
                    <div class="px-6 pb-4 text-gray-600 hidden">Iya, kami menerima pemesanan acara kecil seperti
                        gathering, workshop kopi, dan private event — hubungi kami untuk detail.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-amber-600 text-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-4xl font-bold mb-6">Siap Menikmati Secangkir Kopi Spesial?</h2>
            <p class="text-lg mb-8 opacity-90">Pesan sekarang atau mampir langsung — kami tunggu untuk menyajikan kopi
                terbaik.</p><a href="#contact"
                class="bg-white text-amber-600 hover:bg-gray-100 px-8 py-4 rounded-full font-semibold text-lg transition">Pesan
                Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-4 gap-12">
            <div>
                <div class="flex items-center mb-4"><img src="{{ asset('LOGO_PRIMER.png') }}"
                        alt="Logo Brown Bean Coffee" class="h-20 w-auto"></div>
                <p class="text-gray-400 mb-4">Brown Bean Coffee — tempat dimana setiap cangkir menceritakan cerita.</p>
                <div class="flex space-x-4"><a href="#" class="hover:text-white"><i class="fab fa-facebook-f"></i></a><a
                        href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a><a href="#"
                        class="hover:text-white"><i class="fab fa-instagram"></i></a><a href="#"
                        class="hover:text-white"><i class="fab fa-linkedin"></i></a></div>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#home" class="hover:text-white">Home</a></li>
                    <li><a href="#about" class="hover:text-white">About</a></li>
                    <li><a href="#menu" class="hover:text-white">Menu</a></li>
                    <li><a href="#contact" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Our Offerings</h4>
                <ul class="space-y-2">
                    <li><a href="#menu" class="hover:text-white">Espresso & Drip</a></li>
                    <li><a href="#menu" class="hover:text-white">Cold Brew</a></li>
                    <li><a href="#menu" class="hover:text-white">Pastry</a></li>
                    <li><a href="#menu" class="hover:text-white">Event & Catering</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Contact Info</h4>
                <ul class="space-y-4">
                    <li class="flex items-start"><i
                            class="fas fa-map-marker-alt text-amber-500 mr-3 mt-1"></i><span>Jalan Raya Tlogomas No 246,
                            Kota Malang</span></li>
                    <li class="flex items-start"><i
                            class="fas fa-phone text-amber-500 mr-3 mt-1"></i><span>000000000</span></li>
                    <li class="flex items-start"><i
                            class="fas fa-envelope text-amber-500 mr-3 mt-1"></i><span>info@brownbreancoffee.id</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-12 border-t border-gray-700 pt-6 text-center text-gray-400 text-sm">© 2025 Sofyan Informatika UMM
        </div>
    </footer>

    <!-- Keranjang Belanja & Overlay -->
    <div id="cart-overlay" class="fixed inset-0 bg-black/50 z-40 hidden transition-opacity duration-300"></div>
    <div id="cart-panel"
        class="fixed top-0 right-0 w-full max-w-sm h-full bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50 flex flex-col text-gray-800">
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="font-bold text-lg">Keranjang Belanja</h2><button id="close-cart"><i
                    class="fas fa-times text-gray-600 text-xl hover:text-red-500 transition"></i></button>
        </div>
        <div id="cart-items" class="flex-1 overflow-y-auto p-4 space-y-4"></div>
        <div class="border-t p-4 bg-gray-50">
            <div class="flex justify-between font-semibold mb-3"><span>Total:</span><span id="cart-total">Rp 0</span>
            </div><button id="checkout-btn"
                class="w-full bg-amber-600 text-white py-3 rounded-lg hover:bg-amber-700 transition font-semibold">Checkout</button>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        document.querySelectorAll(".faq-toggle").forEach(button => { button.addEventListener("click", () => { const answer = button.nextElementSibling; const icon = button.querySelector("i"); document.querySelectorAll(".faq-toggle").forEach(btn => { if (btn !== button) { btn.nextElementSibling.classList.add("hidden"); btn.querySelector("i").classList.remove("rotate-180"); } }); answer.classList.toggle("hidden"); icon.classList.toggle("rotate-180"); }); });
        const mobileBtn = document.getElementById('mobile-menu-btn'); const mobileMenu = document.getElementById('mobile-menu'); mobileBtn.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); });
        const nav = document.getElementById('navbar'); window.addEventListener('scroll', () => { if (window.scrollY > 50) { nav.classList.add('bg-white/95', 'shadow-lg'); nav.classList.remove('bg-transparent'); } else { nav.classList.remove('bg-white/95', 'shadow-lg'); nav.classList.add('bg-transparent'); } });
        window.addEventListener('load', () => { document.getElementById('hero-content').classList.remove('opacity-0', 'translate-y-4'); });

        @auth
            localStorage.setItem('user_id', '{{ Auth::id() }}');
        @endauth

        const userId = localStorage.getItem('user_id') || 'guest'; const CART_KEY = `cart_${userId}`; let cart = JSON.parse(localStorage.getItem(CART_KEY)) || []; const cartPanel = document.getElementById('cart-panel'); const cartBtn = document.getElementById('cart-btn'); const closeCartBtn = document.getElementById('close-cart'); const cartItems = document.getElementById('cart-items'); const cartTotal = document.getElementById('cart-total'); const cartCount = document.getElementById('cart-count'); const cartOverlay = document.getElementById('cart-overlay');
        function updateCart() { cartItems.innerHTML = ''; let total = 0; if (cart.length === 0) { cartItems.innerHTML = '<p class="text-center text-gray-500">Keranjang Anda kosong.</p>'; } else { cart.forEach((item, index) => { let subtotal = item.price * item.qty; total += subtotal; cartItems.innerHTML += `<div class="flex justify-between items-center border-b pb-3"><div class="flex items-center gap-3"><img src="{{ asset('LOGO_PRIMER.png') }}" alt="${item.name}" class="w-16 h-16 object-cover rounded-md"><div><p class="font-semibold">${item.name}</p><p class="text-sm text-gray-500">Rp ${item.price.toLocaleString()}</p></div></div><div class="flex items-center gap-2"><button onclick="changeQty(${index}, -1)" class="w-7 h-7 border rounded-full hover:bg-gray-100">-</button><span>${item.qty}</span><button onclick="changeQty(${index}, 1)" class="w-7 h-7 border rounded-full hover:bg-gray-100">+</button></div></div>`; }); } cartTotal.textContent = "Rp " + total.toLocaleString(); const totalItems = cart.reduce((a, b) => a + b.qty, 0); cartCount.textContent = totalItems; cartCount.classList.toggle('hidden', totalItems === 0); localStorage.setItem(CART_KEY, JSON.stringify(cart)); }
        function changeQty(index, delta) { cart[index].qty += delta; if (cart[index].qty <= 0) cart.splice(index, 1); updateCart(); }
        document.querySelectorAll('.add-to-cart').forEach(btn => { btn.addEventListener('click', () => { const name = btn.dataset.name; const price = parseInt(btn.dataset.price); const existing = cart.find(item => item.name === name); if (existing) { existing.qty++; } else { cart.push({ name, price, qty: 1 }); } updateCart(); btn.innerHTML = '<i class="fas fa-check"></i> Ditambahkan!'; btn.classList.add('bg-green-500', 'hover:bg-green-600'); btn.classList.remove('bg-[#6b3e26]'); setTimeout(() => { btn.innerHTML = 'Tambah ke Keranjang'; btn.classList.remove('bg-green-500', 'hover:bg-green-600'); btn.classList.add('bg-[#6b3e26]'); }, 1500); }); });
        function openCart() { cartPanel.classList.remove('translate-x-full'); cartOverlay.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
        function closeCartPanel() { cartPanel.classList.add('translate-x-full'); cartOverlay.classList.add('hidden'); document.body.style.overflow = ''; }
        cartBtn.addEventListener('click', openCart); closeCartBtn.addEventListener('click', closeCartPanel); cartOverlay.addEventListener('click', closeCartPanel); updateCart();
    </script>
</body>

</html>