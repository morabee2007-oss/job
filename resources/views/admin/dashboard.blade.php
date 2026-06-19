<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                <p class="mt-2 text-gray-600">
                    Manage users, job posts, and categories from one place.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('admin.users.index') }}"
                   class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-blue-200 transition block">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">
                        U
                    </div>
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">Manage Users</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        View accounts, monitor roles, and control activation status.
                    </p>
                </a>

                <a href="{{ route('admin.job-posts.index') }}"
                   class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-green-200 transition block">
                    <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-bold text-lg">
                        J
                    </div>
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">Manage Job Posts</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Review job listings, open or close posts, and remove unwanted ones.
                    </p>
                </a>

                <a href="{{ route('admin.job-categories.index') }}"
                   class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-purple-200 transition block">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-lg">
                        C
                    </div>
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">Manage Categories</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Organize the platform by creating and editing job categories.
                    </p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
