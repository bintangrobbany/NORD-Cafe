@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    {{-- Kode di file ini sekarang hanya berisi konten utama halaman dasbor --}}
    {{-- Tombol logout sudah tidak ada lagi di sini karena sudah pindah ke layout --}}

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Kartu Total Produk -->
        <div class="bg-white p-6 rounded-xl shadow-lg flex items-center">
            <div class="bg-amber-600 text-white rounded-full h-16 w-16 flex items-center justify-center">
                <i class="fas fa-coffee text-3xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Produk</h3>
                <p class="text-3xl font-bold mt-1">{{ $totalProducts }}</p>
            </div>
        </div>

        <!-- Kartu Pesanan Pending -->
        <div class="bg-white p-6 rounded-xl shadow-lg flex items-center">
            <div class="bg-orange-500 text-white rounded-full h-16 w-16 flex items-center justify-center">
                <i class="fas fa-clock text-3xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Pesanan Pending</h3>
                <p class="text-3xl font-bold mt-1">{{ $pendingOrders }}</p>
            </div>
        </div>

        <!-- Anda bisa menambahkan kartu statistik lainnya di sini -->
        <div class="bg-white p-6 rounded-xl shadow-lg flex items-center">
            <div class="bg-green-500 text-white rounded-full h-16 w-16 flex items-center justify-center">
                <i class="fas fa-dollar-sign text-3xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Penjualan</h3>
                <p class="text-3xl font-bold mt-1">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
@endsection