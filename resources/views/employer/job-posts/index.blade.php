<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">My Job Posts</h1>
                    <p class="mt-2 text-gray-600">
                        Manage all your published opportunities in one place.
                    </p>
                </div>

                <a href="{{ route('employer.job-posts.create') }}"
                   class="inline-flex items-center justify-center bg-blue-600 text-white px-6 py-3 rounded-full font-medium hover:bg-blue-700 transition">
                    Add Job Post
                </a>
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

                                <div class="flex flex-wrap gap-2 mt-3 text-sm">
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                        {{ $job->location ?? 'No location' }}
                                    </span>

                                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full">
                                        {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
                                    </span>

                                    <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 md:justify-end">
    <a href="{{ route('employer.job-posts.show', $job) }}"
       class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-full bg-gray-900 text-white text-sm font-semibold hover:bg-gray-800 transition">
        <span>View</span>
    </a>

    <a href="{{ route('employer.job-posts.edit', $job) }}"
       class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-sm font-semibold hover:bg-amber-100 transition">
        <span>Edit</span>
    </a>

    <form action="{{ route('employer.job-posts.destroy', $job) }}" method="POST" class="inline-flex"
          onsubmit="return confirm('Delete this job?')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-full bg-red-50 text-red-700 border border-red-200 text-sm font-semibold hover:bg-red-100 transition">
            <span>Delete</span>
        </button>
    </form>
</div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-800">No job posts found</h3>
                        <p class="text-gray-500 mt-2">
                            Create your first job post to start receiving applications.
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
