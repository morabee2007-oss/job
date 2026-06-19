<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Job Posts Management</h1>
                <p class="mt-2 text-gray-600">
                    Review employer posts and manage their approval status.
                </p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-5">
                @forelse($jobs as $job)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex flex-col md:flex-row md:justify-between gap-5">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-900">{{ $job->title }}</h2>
                                <p class="mt-1 text-gray-700 font-medium">{{ $job->employer->name }}</p>

                                <div class="flex flex-wrap gap-2 mt-3 text-sm">
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                        {{ $job->category?->name ?? 'No category' }}
                                    </span>

                                    <span class="
                                        {{ $job->approval_status === 'approved' ? 'bg-green-50 text-green-700' : '' }}
                                        {{ $job->approval_status === 'pending' ? 'bg-yellow-50 text-yellow-700' : '' }}
                                        {{ $job->approval_status === 'rejected' ? 'bg-red-50 text-red-700' : '' }}
                                        px-3 py-1 rounded-full
                                    ">
                                        Approval: {{ ucfirst($job->approval_status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 md:justify-end">
                                <a href="{{ route('admin.job-posts.show', $job) }}"
                                   class="inline-flex items-center justify-center h-11 px-5 rounded-full bg-gray-900 text-white text-sm font-semibold hover:bg-gray-800 transition">
                                    View
                                </a>

                                @if($job->approval_status !== 'approved')
                                    <form action="{{ route('admin.job-posts.approve', $job) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="inline-flex items-center justify-center h-11 px-5 rounded-full bg-green-50 text-green-700 border border-green-200 text-sm font-semibold hover:bg-green-100 transition">
                                            Approve
                                        </button>
                                    </form>
                                @endif

                                @if($job->approval_status !== 'rejected')
                                    <form action="{{ route('admin.job-posts.reject', $job) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="inline-flex items-center justify-center h-11 px-5 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-sm font-semibold hover:bg-amber-100 transition">
                                            Reject
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.job-posts.destroy', $job) }}" method="POST" class="inline-flex"
                                      onsubmit="return confirm('Delete this job post?')">
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
                        <h3 class="text-xl font-semibold text-gray-800">No job posts found</h3>
                        <p class="text-gray-500 mt-2">
                            Job posts will appear here once employers create them.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
