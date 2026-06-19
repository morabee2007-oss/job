<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-6">
                <a href="{{ route('employer.job-posts.index') }}"
                   class="text-blue-600 hover:text-blue-700 font-medium">
                    ← Back to job posts
                </a>
            </div>

            <div class="grid lg:grid-cols-12 gap-6">
                <!-- Job Details -->
                <div class="lg:col-span-8">
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $job->title }}</h1>

                        <div class="flex flex-wrap gap-2 mt-4 text-sm">
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                {{ $job->category?->name ?? 'No category' }}
                            </span>

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

                        <div class="grid md:grid-cols-2 gap-4 mt-6">
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <p class="text-sm text-gray-500">Salary</p>
                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ $job->salary_min ?? '-' }} - {{ $job->salary_max ?? '-' }}
                                </p>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <p class="text-sm text-gray-500">Deadline</p>
                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ optional($job->deadline)->format('Y-m-d') ?? 'Not specified' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-900 mb-3">Job Description</h2>
                            <div class="text-gray-700 leading-7 whitespace-pre-line">
                                {{ $job->description }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Applications -->
                <div class="lg:col-span-4">
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                        <h2 class="text-xl font-semibold text-gray-900">Applications</h2>
                        <p class="mt-2 text-sm text-gray-600">
                            Review candidate responses for this job post.
                        </p>

                        <div class="mt-6 space-y-4">
                            @forelse($job->applications as $application)
                                <div class="border border-gray-200 rounded-2xl p-4">
                                    <p class="font-semibold text-gray-900">{{ $application->candidate->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $application->candidate->email }}</p>

                                    <p class="mt-3 text-sm">
                                        <span class="font-medium text-gray-700">Status:</span>
                                        <span class="text-gray-600">{{ ucfirst($application->status) }}</span>
                                    </p>

                                    <div class="mt-3">
                                        <p class="text-sm font-medium text-gray-700">Cover Letter</p>
                                        <p class="mt-1 text-sm text-gray-600 whitespace-pre-line">
                                            {{ $application->cover_letter ?: 'No cover letter provided.' }}
                                        </p>
                                    </div>

                                    @if($application->resume)
                                        <div class="mt-4">
                                            <a href="{{ asset('storage/' . $application->resume) }}"
                                               target="_blank"
                                               class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium hover:bg-blue-100 transition">
                                                View CV
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-center py-6">
                                    <p class="text-gray-500">No applications yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
