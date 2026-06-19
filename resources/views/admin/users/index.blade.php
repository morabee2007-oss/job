<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Users Management</h1>
                <p class="mt-2 text-gray-600">
                    Review user accounts and control whether they are active.
                </p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 text-red-700 border border-red-200 rounded-2xl">
                    {{ session('error') }}
                </div>
            @endif

            <div class="space-y-5">
                @forelse($users as $user)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-5">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h2>
                                <p class="mt-1 text-gray-600">{{ $user->email }}</p>

                                <div class="flex flex-wrap gap-2 mt-3 text-sm">
                                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full">
                                        {{ ucfirst($user->role) }}
                                    </span>

                                    <span class="{{ $user->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }} px-3 py-1 rounded-full">
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>

                            @if($user->role !== 'admin')
                                <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="inline-flex items-center justify-center h-11 px-5 rounded-full text-sm font-semibold transition
                                            {{ $user->is_active
                                                ? 'bg-red-50 text-red-700 border border-red-200 hover:bg-red-100'
                                                : 'bg-green-50 text-green-700 border border-green-200 hover:bg-green-100' }}">
                                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-800">No users found</h3>
                        <p class="text-gray-500 mt-2">
                            User accounts will appear here once they register.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
