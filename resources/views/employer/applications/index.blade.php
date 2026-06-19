<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Applications</h1>
                <p class="mt-2 text-gray-600">
                    Review incoming applications and update candidate status.
                </p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 border border-green-200 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-5">
                @forelse($applications as $application)
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex flex-col lg:flex-row lg:justify-between gap-6">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-900">
                                    {{ $application->job->title }}
                                </h2>

                                <p class="mt-1 text-gray-700 font-medium">
                                    Candidate: {{ $application->candidate->name }}
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $application->candidate->email }}
                                </p>

                                <div class="mt-4">
                                    <p class="text-sm font-medium text-gray-700">Cover Letter</p>
                                    <p class="mt-2 text-sm text-gray-600 leading-6 whitespace-pre-line">
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

                            <div class="lg:w-80">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                        'reviewed' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'accepted' => 'bg-green-50 text-green-700 border-green-200',
                                        'rejected' => 'bg-red-50 text-red-700 border-red-200',
                                    ];
                                @endphp

                                <div class="mb-4">
                                    <span class="inline-flex px-4 py-2 rounded-full text-sm font-medium border {{ $statusColors[$application->status] ?? 'bg-gray-100 text-gray-700 border-gray-200' }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>

                                <form action="{{ route('employer.applications.update-status', $application) }}" method="POST" class="space-y-3">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status"
                                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="reviewed" {{ $application->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                        <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>

                                    <button type="submit"
                                            class="w-full bg-blue-600 text-white px-4 py-3 rounded-full font-medium hover:bg-blue-700 transition">
                                        Update Status
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-800">No applications found</h3>
                        <p class="text-gray-500 mt-2">
                            Applications will appear here once candidates start applying.
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
