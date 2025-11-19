@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Daftar Produk</h2>
            <a href="{{ route('admin.products.create') }}"
                class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors flex items-center">
                <i class="fas fa-plus mr-2"></i>Tambah Produk
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-[#3E2723] text-white">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Harga</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Stok</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($products as $product)
                        <tr class="border-b hover:bg-amber-50/50">
                            <td class="py-3 px-4 font-medium">{{ $product->name }}</td>
                            <td class="py-3 px-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">{{ $product->stock }}</td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="text-yellow-600 hover:text-yellow-800 font-semibold mr-4">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Anda yakin ingin menghapus produk ini? Tindakan ini tidak bisa dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">Belum ada produk yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
@endsection