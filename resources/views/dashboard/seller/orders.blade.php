<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incoming Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4">Order Date</th>
                            <th class="p-4">Order ID</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Product</th>
                            <th class="p-4">Qty</th>
                            <th class="p-4">Total Price</th>
                            <th class="p-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td class="p-4 font-mono font-bold">#{{ $item->order->id }}</td>
                            <td class="p-4">{{ $item->order->user->name }}</td>
                            <td class="p-4 flex items-center gap-2">
                                <img src="{{ $item->product->image }}" class="w-8 h-8 rounded object-cover">
                                {{ $item->product->name }}
                            </td>
                            <td class="p-4">{{ $item->quantity }}</td>
                            <td class="p-4 font-bold text-hiyoucan-700">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs font-bold">{{ ucfirst($item->order->status) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $orderItems->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>