<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management & Seller Verification') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-sm text-gray-600 uppercase">
                                <th class="p-4 border-b">Name</th>
                                <th class="p-4 border-b">Email</th>
                                <th class="p-4 border-b">Role</th>
                                <th class="p-4 border-b">Status</th>
                                <th class="p-4 border-b text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-4 font-bold">{{ $user->name }}</td>
                                <td class="p-4">{{ $user->email }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $user->role == 'manager' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst($user->role == 'manager' ? 'Seller' : 'Buyer') }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($user->role == 'manager')
                                        @if($user->email_verified_at)
                                            <span class="text-green-600 font-bold">Approved</span>
                                        @else
                                            <span class="text-red-500 font-bold animate-pulse">Pending</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="p-4 text-right space-x-2">
                                    @if($user->role == 'manager')
                                        <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @if(!$user->email_verified_at)
                                                <input type="hidden" name="action" value="approve">
                                                <button type="submit" class="text-green-600 hover:underline font-bold">Approve</button>
                                            @else
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="text-orange-500 hover:underline">Reject</button>
                                            @endif
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>