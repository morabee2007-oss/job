<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">

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

            <div class="grid lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8">
                    <div class="bg-white border border-gray-200 rounded-3xl p-6 md:p-8 shadow-sm">
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xl shrink-0">
                                {{ strtoupper(substr($job->employer->companyProfile->company_name ?? $job->employer->name, 0, 1)) }}
                            </div>

                            <div class="flex-1">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $job->title }}</h1>
                                <p class="mt-1 text-lg font-medium text-gray-700">
                                    {{ $job->employer->companyProfile->company_name ?? $job->employer->name }}
                                </p>

                                <div class="flex flex-wrap gap-2 mt-4 text-sm">
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                        {{ $job->location ?? 'No location' }}
                                    </span>

                                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full">
                                        {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
                                    </span>

                                    <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full">
                                        {{ $job->category?->name ?? 'No category' }}
                                    </span>

                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                        Status: {{ ucfirst($job->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mt-6">
                            <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
                                <p class="text-sm text-gray-500">Salary Range</p>
                                <p class="mt-1 font-semibold text-gray-900">
                                    {{ $job->salary_min ?? '-' }} - {{ $job->salary_max ?? '-' }}
                                </p>
                            </div>

                            <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
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

                <div class="lg:col-span-4">
                    <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm sticky top-24">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Apply for this Job</h2>
                            <p class="mt-2 text-sm text-gray-600">
                                Submit your application and upload your latest CV.
                            </p>
                        </div>

                        <form action="{{ route('candidate.jobs.apply', $job) }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="space-y-5">
                            @csrf

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Cover Letter
                                </label>
                                <textarea
                                    name="cover_letter"
                                    rows="6"
                                    class="w-full border border-gray-300 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Write a short cover letter..."
                                >{{ old('cover_letter') }}</textarea>

                                @error('cover_letter')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Upload CV
                                </label>

                                <label for="resume"
                                       class="group relative flex flex-col items-center justify-center w-full rounded-3xl border-2 border-dashed border-gray-300 bg-gradient-to-b from-gray-50 to-white px-6 py-10 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                                    <div class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-4 group-hover:scale-105 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 16a4 4 0 01.88-7.903A5 5 0 0115.9 6L16 6a5 5 0 011 9.9M12 12v9m0 0l-3-3m3 3l3-3"/>
                                        </svg>
                                    </div>

                                    <h3 class="text-base font-semibold text-gray-900">
                                        Upload your CV
                                    </h3>

                                    <p class="mt-2 text-sm text-gray-500">
                                        Drag & drop your file here or
                                        <span class="text-blue-600 font-medium">browse</span>
                                    </p>

                                    <p class="mt-2 text-xs text-gray-400">
                                        Accepted formats: PDF, DOC, DOCX
                                    </p>

                                    <input
                                        id="resume"
                                        type="file"
                                        name="resume"
                                        accept=".pdf,.doc,.docx"
                                        class="hidden"
                                        onchange="document.getElementById('file-name').innerText = this.files[0] ? this.files[0].name : 'No file selected';"
                                    >
                                </label>

                                <div class="mt-3 flex items-center justify-between rounded-2xl bg-gray-50 border border-gray-200 px-4 py-3">
                                    <div>
                                        <p class="text-xs text-gray-500">Selected file</p>
                                        <p id="file-name" class="text-sm font-medium text-gray-800">No file selected</p>
                                    </div>
                                    <span class="text-xs text-gray-400">Max: 2MB</span>
                                </div>

                                @error('resume')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="w-full bg-blue-600 text-white px-4 py-3.5 rounded-2xl font-semibold hover:bg-blue-700 transition shadow-sm"
                            >
                                Apply Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
