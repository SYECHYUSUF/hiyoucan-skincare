<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incoming Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4">Date</th>
                            <th class="p-4">Order ID</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Address</th>
                            <th class="p-4">Product</th>
                            <th class="p-4">Qty</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4 text-gray-500">{{ $item->created_at->format('d/m/y') }}</td>
                            <td class="p-4 font-mono font-bold">#ORD-{{ $item->order->id }}</td>
                            <td class="p-4">
                                <span class="font-bold block">{{ $item->order->user->name }}</span>
                            </td>
                            <td class="p-4 max-w-xs truncate" title="{{ $item->order->address }}">
                                {{ $item->order->address }}
                            </td>
                            <td class="p-4 flex items-center gap-2">
                                <img src="{{ $item->product->image }}" class="w-8 h-8 rounded object-cover">
                                {{ $item->product->name }}
                            </td>
                            <td class="p-4">{{ $item->quantity }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 rounded text-xs font-bold 
                                    {{ $item->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $item->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $item->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $item->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <form action="{{ route('seller.orders.update-status', $item->id) }}" method="POST" class="flex justify-end gap-2">
                                    @csrf
                                    @method('PATCH')
                                    
                                    @if($item->status == 'pending')
                                        <button name="status" value="processing" class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700 transition">Accept</button>
                                        <button name="status" value="cancelled" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700 transition" onclick="return confirm('Reject this item?')">Reject</button>
                                    @elseif($item->status == 'processing')
                                        <button name="status" value="completed" class="bg-green-600 text-white px-2 py-1 rounded text-xs hover:bg-green-700 transition">Mark Done</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $orderItems->links() }}</div>
            </div>
        </div>
    </div>
</x-dashboard-layout>