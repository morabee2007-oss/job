<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Available Jobs</h1>
                <p class="mt-2 text-gray-600">
                    Search and filter available opportunities.
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

            <form method="GET" action="{{ route('candidate.jobs.index') }}"
                  class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 md:p-5 grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search jobs..."
                    class="border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <select
                    name="job_category_id"
                    class="border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('job_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select
                    name="job_type"
                    class="border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">All Types</option>
                    <option value="full_time" {{ request('job_type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                    <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                    <option value="remote" {{ request('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                    <option value="freelance" {{ request('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                </select>

                <input
                    type="text"
                    name="location"
                    value="{{ request('location') }}"
                    placeholder="Location..."
                    class="border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <div class="md:col-span-4 flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded-full font-medium hover:bg-blue-700 transition">
                        Filter Jobs
                    </button>

                    <a href="{{ route('candidate.jobs.index') }}"
                       class="border border-gray-300 text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-gray-50 transition">
                        Reset
                    </a>
                </div>
            </form>

            <div class="space-y-5">
                @forelse($jobs as $job)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-blue-200 transition">
                        <div class="flex flex-col md:flex-row md:justify-between gap-5">
                            <div class="flex gap-4 flex-1">
                                <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg shrink-0">
                                    {{ strtoupper(substr($job->employer->companyProfile->company_name ?? $job->employer->name, 0, 1)) }}
                                </div>

                                <div class="flex-1">
                                    <h2 class="text-xl font-semibold text-gray-900">{{ $job->title }}</h2>

                                    <p class="text-gray-700 font-medium mt-1">
                                        {{ $job->employer->companyProfile->company_name ?? $job->employer->name }}
                                    </p>

                                    <div class="flex flex-wrap gap-2 mt-3 text-sm">
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                            {{ $job->location ?? 'No location' }}
                                        </span>

                                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full">
                                            {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
                                        </span>

                                        <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full">
                                            {{ $job->category?->name ?? 'No category' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="md:w-44">
                                <a href="{{ route('candidate.jobs.show', $job) }}"
                                   class="block bg-gray-900 text-white px-4 py-2.5 rounded-full text-center font-medium hover:bg-black transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-800">No jobs found</h3>
                        <p class="text-gray-500 mt-2">
                            Try adjusting your filters.
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
