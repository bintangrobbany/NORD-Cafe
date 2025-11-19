@extends('layouts.admin')
@section('title', 'Manajemen Pesanan')
@section('content')
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Daftar Pesanan</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead class="bg-[#3E2723] text-white">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">ID</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Pelanggan</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Total</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Tanggal</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Status</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($orders as $order)
                        <tr class="border-b hover:bg-amber-50/50">
                            <td class="py-3 px-4 font-medium">#{{ $order->id }}</td>
                            <td class="py-3 px-4">{{ $order->customer_name }}</td>
                            <td class="py-3 px-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($order->status == 'pending') bg-yellow-200 text-yellow-800
                                        @elseif($order->status == 'shipped') bg-blue-200 text-blue-800
                                        @elseif($order->status == 'completed') bg-green-200 text-green-800
                                        @else bg-gray-200 text-gray-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('admin.orders.review', $order) }}"
                                    class="bg-amber-600 text-white px-3 py-1 rounded-lg text-xs font-semibold hover:bg-amber-700">
                                    Review
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">Belum ada pesanan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $orders->links() }}</div>
    </div>
@endsection