<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-1/3">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="font-bold text-lg mb-4">Add New Category</h3>
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                            <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-hiyoucan-500 focus:border-hiyoucan-500" required placeholder="e.g. Serums">
                        </div>
                        <button type="submit" class="w-full bg-hiyoucan-700 text-white py-2 rounded-md hover:bg-hiyoucan-800">Save Category</button>
                    </form>
                </div>
            </div>

            <div class="w-full lg:w-2/3 bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="p-4 text-sm font-bold text-gray-600">Name</th>
                                <th class="p-4 text-sm font-bold text-gray-600">Slug</th>
                                <th class="p-4 text-sm font-bold text-gray-600">Products Count</th>
                                <th class="p-4 text-right text-sm font-bold text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                        @foreach($categories as $cat)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-bold text-gray-900">{{ $cat->name }}</td>
                            <td class="p-4 text-gray-500 italic font-mono">{{ $cat->slug }}</td>
                            <td class="p-4">
                                <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded-full text-xs font-bold border border-blue-100">
                                    {{ $cat->products_count }} Products
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex justify-end items-center gap-2">
                                    
                                    <a href="{{ route('admin.categories.edit', $cat->id) }}" class="text-blue-600 hover:text-white hover:bg-blue-600 p-2 rounded transition shadow-sm" title="Edit Category">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Are you sure? Deleting this category might affect products linked to it.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-white hover:bg-red-600 p-2 rounded transition shadow-sm" title="Delete Category">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>

        </div>
    </div>
</x-dashboard-layout>   