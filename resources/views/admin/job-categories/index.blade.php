<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Job Categories</h1>
                    <p class="mt-2 text-gray-600">
                        Create and manage categories used across job posts.
                    </p>
                </div>

                <a href="{{ route('admin.job-categories.create') }}"
                   class="inline-flex items-center justify-center bg-blue-600 text-white px-6 py-3 rounded-full font-medium hover:bg-blue-700 transition">
                    Add Category
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-5">
                @forelse($categories as $category)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-5">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">{{ $category->name }}</h2>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 md:justify-end">
                                <a href="{{ route('admin.job-categories.edit', $category) }}"
                                   class="inline-flex items-center justify-center h-11 px-5 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-sm font-semibold hover:bg-amber-100 transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.job-categories.destroy', $category) }}" method="POST" class="inline-flex"
                                      onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center justify-center h-11 px-5 rounded-full bg-red-50 text-red-700 border border-red-200 text-sm font-semibold hover:bg-red-100 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-800">No categories found</h3>
                        <p class="text-gray-500 mt-2">
                            Create a category to start organizing job posts.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
