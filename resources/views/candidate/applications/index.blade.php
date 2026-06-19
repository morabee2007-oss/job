<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">My Applications</h1>
                <p class="mt-2 text-gray-600">
                    Review the jobs you have applied for and their current status.
                </p>
            </div>

            <div class="space-y-5">
                @forelse($applications as $application)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">
                                    {{ $application->job->title }}
                                </h2>

                                <p class="mt-1 text-gray-700 font-medium">
                                    {{ $application->job->employer->companyProfile->company_name ?? $application->job->employer->name }}
                                </p>

                                <p class="mt-3 text-sm text-gray-500">
                                    Applied at: {{ $application->created_at->format('Y-m-d H:i') }}
                                </p>
                            </div>

                            <div>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-50 text-yellow-700',
                                        'reviewed' => 'bg-blue-50 text-blue-700',
                                        'accepted' => 'bg-green-50 text-green-700',
                                        'rejected' => 'bg-red-50 text-red-700',
                                    ];
                                @endphp

                                <span class="px-4 py-2 rounded-full text-sm font-medium {{ $statusColors[$application->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-800">No applications found</h3>
                        <p class="text-gray-500 mt-2">
                            Start applying to jobs and your applications will appear here.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
