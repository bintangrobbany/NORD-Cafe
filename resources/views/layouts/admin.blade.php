<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - ADMIN NORD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-link.active {
            background-color: #D97706;
            /* bg-amber-600 */
            color: white;
            font-weight: 600;
        }

        .sidebar-link:hover {
            background-color: #451a03;
            /* Aksen coklat lebih tua */
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-[#3E2723] text-gray-200 flex flex-col shadow-lg">
            <div class="px-6 py-6 border-b border-gray-700/50">
                <h2 class="text-2xl font-bold text-white tracking-wider">Admin Panel</h2>
                <span class="text-sm text-amber-300">NORD Cafe</span>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors @if(request()->routeIs('admin.dashboard')) active @endif">
                    <i class="fas fa-tachometer-alt fa-fw mr-3"></i> Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}"
                    class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors @if(request()->routeIs('admin.products.*')) active @endif">
                    <i class="fas fa-coffee fa-fw mr-3"></i> Produk
                </a>
                <a href="{{ route('admin.orders.index') }}"
                    class="sidebar-link flex items-center px-4 py-2.5 rounded-lg transition-colors @if(request()->routeIs('admin.orders.*')) active @endif">
                    <i class="fas fa-receipt fa-fw mr-3"></i> Pesanan
                </a>
            </nav>

            <!-- ========================================================================= -->
            <!-- DIUBAH: Logout sekarang menggunakan form POST ke route 'admin.logout' -->
            <!-- ========================================================================= -->
            <div class="px-6 py-4 border-t border-gray-700/50">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2.5 rounded-lg text-red-400 hover:bg-red-500 hover:text-white transition-colors">
                        <i class="fas fa-sign-out-alt fa-fw mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                <div class="text-gray-700">
                    <!-- ===================================================================== -->
                    <!-- DIUBAH: Menggunakan Auth::guard('admin') untuk mendapatkan nama admin -->
                    <!-- ===================================================================== -->
                    Selamat datang, <span
                        class="font-bold text-amber-700">{{ Auth::guard('admin')->user()->name }}</span>
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-md shadow-sm"
                        role="alert">
                        <p class="font-bold">Sukses!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>