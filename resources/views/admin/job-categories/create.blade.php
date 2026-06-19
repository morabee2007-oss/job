<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-3xl mx-auto px-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Create Category</h1>
                <p class="mt-2 text-gray-600">
                    Add a new category to organize job listings.
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                <form action="{{ route('admin.job-categories.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-blue-600 text-white px-6 py-3 rounded-full font-medium hover:bg-blue-700 transition">
                            Save Category
                        </button>

                        <a href="{{ route('admin.job-categories.index') }}"
                           class="border border-gray-300 text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-gray-50 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
