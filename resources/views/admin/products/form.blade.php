@extends('layouts.admin')

@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk Baru')

@section('content')
    <div class="bg-white p-8 rounded-xl shadow-lg max-w-2xl mx-auto">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">
            {{ isset($product) ? 'Edit Produk: ' . $product->name : 'Tambah Produk Baru' }}</h2>
        <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>{{ old('description', $product->description ?? '') }}</textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="price" class="block text-gray-700 font-medium mb-2">Harga (Rp)</label>
                    <input type="number" step="any" id="price" name="price"
                        value="{{ old('price', $product->price ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                        required>
                </div>
                <div>
                    <label for="stock" class="block text-gray-700 font-medium mb-2">Stok</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500"
                        required>
                </div>
            </div>
            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Produk</label>
                <input type="file" id="image" name="image"
                    class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                @if(isset($product) && $product->image)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="h-32 w-32 object-cover rounded-md">
                    </div>
                @endif
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">Batal</a>
                <button type="submit" class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700">Simpan
                    Produk</button>
            </div>
        </form>
    </div>
@endsection