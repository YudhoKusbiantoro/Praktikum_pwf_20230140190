<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1e2336] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-white tracking-tight">
                                Category List
                            </h2>
                            <p class="text-sm text-gray-400 mt-1">
                                Manage your category
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('category.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md transition duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Category
                            </a>
                        </div>
                    </div>

                    <!-- Flash Message -->
                    @if (session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-900/30 border border-green-700 text-green-300 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="bg-[#1a1e2e] rounded-lg border border-gray-700 overflow-hidden mt-6">
                        <table class="min-w-full text-sm text-gray-300">
                            <thead class="bg-[#2a3042] text-xs font-semibold uppercase tracking-wider text-gray-400">
                                <tr>
                                    <th class="px-6 py-4 text-left w-16">#</th>
                                    <th class="px-6 py-4 text-left">NAME</th>
                                    <th class="px-6 py-4 text-left">TOTAL PRODUCT</th>
                                    <th class="px-6 py-4 text-left">ACTION</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-700/50 bg-[#1e2336]">
                                @forelse ($categories as $index => $category)
                                    <tr class="hover:bg-white/5 transition duration-100">
                                        <td class="px-6 py-4">{{ $categories->firstItem() + $index }}</td>
                                        <td class="px-6 py-4">{{ $category->name }}</td>
                                        <td class="px-6 py-4">{{ $category->products_count }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <!-- Edit -->
                                                <a href="{{ route('category.edit', $category->id) }}" class="text-gray-400 hover:text-indigo-400 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <!-- Delete -->
                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-gray-400 hover:text-red-400 transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                            No categories found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($categories->hasPages())
                        <div class="mt-4">
                            {{ $categories->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
