<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f3f2ef] text-gray-900">

    <!-- Navbar -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded bg-blue-600 text-white flex items-center justify-center font-bold text-lg">
                    JP
                </div>
                <span class="text-xl font-semibold text-gray-800">Job Platform</span>
            </div>

            <div class="flex items-center gap-4 text-sm font-medium">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}"
                       class="border border-blue-600 text-blue-600 px-4 py-2 rounded-full hover:bg-blue-50 transition">
                        Join now
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-14 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight text-gray-900">
                    Find the right job for your next career move
                </h1>
                <p class="mt-5 text-lg text-gray-600 max-w-xl">
                    Explore opportunities, view job details, and apply easily once you sign in as a candidate.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#jobs"
                       class="bg-blue-600 text-white px-6 py-3 rounded-full font-medium hover:bg-blue-700 transition">
                        Explore Jobs
                    </a>

                    @guest
                        <a href="{{ route('register') }}"
                           class="border border-gray-300 text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-gray-50 transition">
                            Create Account
                        </a>
                    @endguest
                </div>
            </div>

            <div class="hidden md:flex justify-center">
                <div class="w-full max-w-md bg-[#f3f6f8] border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <div class="space-y-4">
                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                            <p class="text-sm text-gray-500">Software Engineer</p>
                            <p class="font-semibold text-lg">Full Stack Developer</p>
                            <p class="text-sm text-gray-600 mt-1">ramallh • Full Time</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                            <p class="text-sm text-gray-500">Design</p>
                            <p class="font-semibold text-lg">UI/UX Designer</p>
                            <p class="text-sm text-gray-600 mt-1">Remote • Freelance</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                            <p class="text-sm text-gray-500">Marketing</p>
                            <p class="font-semibold text-lg">Digital Marketing Specialist</p>
                            <p class="text-sm text-gray-600 mt-1">Dubai • Part Time</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search / Filter -->
    <section id="jobs" class="max-w-7xl mx-auto px-6 py-8">
        <form method="GET" action="{{ route('home') }}"
              class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 md:p-5 grid grid-cols-1 md:grid-cols-5 gap-4">

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Job title, keyword, or company"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select
                    name="job_category_id"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('job_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                <select
                    name="job_type"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">All Types</option>
                    <option value="full_time" {{ request('job_type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                    <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                    <option value="remote" {{ request('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                    <option value="freelance" {{ request('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input
                    type="text"
                    name="location"
                    value="{{ request('location') }}"
                    placeholder="City or country"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div class="md:col-span-5 flex flex-wrap gap-3 pt-1">
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-full font-medium hover:bg-blue-700 transition"
                >
                    Search Jobs
                </button>

                <a
                    href="{{ route('home') }}"
                    class="border border-gray-300 text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-gray-50 transition"
                >
                    Reset Filters
                </a>
            </div>
        </form>
    </section>

    <!-- Job List -->
    <main class="max-w-7xl mx-auto px-6 pb-12">
        <div class="grid lg:grid-cols-12 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-8 space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">Available Jobs</h2>
                    <p class="text-sm text-gray-500">
                        {{ $jobs->total() }} job{{ $jobs->total() != 1 ? 's' : '' }} found
                    </p>
                </div>

                @forelse($jobs as $job)
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-blue-200 transition">
                        <div class="flex flex-col md:flex-row md:justify-between gap-5">
                            <!-- Left -->
                            <div class="flex gap-4 flex-1">
                                <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg shrink-0">
                                    {{ strtoupper(substr($job->employer->companyProfile->company_name ?? $job->employer->name, 0, 1)) }}
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        {{ $job->title }}
                                    </h3>

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

                                        @if($job->deadline)
                                            <span class="bg-orange-50 text-orange-700 px-3 py-1 rounded-full">
                                                Deadline: {{ $job->deadline->format('M d, Y') }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($job->salary_min || $job->salary_max)
                                        <p class="mt-3 text-sm text-gray-600">
                                            Salary:
                                            <span class="font-medium text-gray-800">
                                                {{ $job->salary_min ?? '-' }} - {{ $job->salary_max ?? '-' }}
                                            </span>
                                        </p>
                                    @endif

                                    @if($job->description)
                                        <p class="mt-3 text-sm text-gray-600 line-clamp-2">
                                            {{ $job->description }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Right -->
                            <div class="flex flex-col gap-2 md:w-44">
                                <a href="{{ route('jobs.show', $job) }}"
                                   class="bg-gray-900 text-white px-4 py-2.5 rounded-full text-center font-medium hover:bg-black transition">
                                    View Details
                                </a>

                                @auth
                                    @if(auth()->user()->role === 'candidate')
                                        <form method="POST" action="{{ route('candidate.jobs.apply', $job) }}">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="w-full bg-blue-600 text-white px-4 py-2.5 rounded-full font-medium hover:bg-blue-700 transition"
                                            >
                                                Apply Now
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                       class="border border-blue-600 text-blue-600 px-4 py-2.5 rounded-full text-center font-medium hover:bg-blue-50 transition">
                                        Sign in to Apply
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-gray-200 rounded-2xl p-10 text-center shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-800">No jobs found</h3>
                        <p class="text-gray-500 mt-2">
                            Try changing your search or filters.
                        </p>
                    </div>
                @endforelse

                <div class="pt-4">
                    {{ $jobs->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-4 space-y-5">
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Why use Job Platform?</h3>
                    <ul class="mt-4 space-y-3 text-sm text-gray-600">
                        <li>• Browse jobs without signing in</li>
                        <li>• View complete job details instantly</li>
                        <li>• Apply quickly as a candidate</li>
                        <li>• Explore jobs by type, category, and location</li>
                    </ul>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Popular Job Types</h3>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-700">Full Time</span>
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-700">Part Time</span>
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-700">Remote</span>
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-700">Freelance</span>
                    </div>
                </div>

                @guest
                    <div class="bg-blue-600 text-white rounded-2xl p-6 shadow-sm">
                        <h3 class="text-lg font-semibold">Ready to apply?</h3>
                        <p class="mt-2 text-sm text-blue-100">
                            Create your candidate account and start applying for jobs.
                        </p>
                        <a href="{{ route('register') }}"
                           class="mt-4 inline-block bg-white text-blue-700 px-5 py-2.5 rounded-full font-medium hover:bg-blue-50 transition">
                            Get Started
                        </a>
                    </div>
                @endguest
            </aside>
        </div>
    </main>
    <!-- Footer -->
<footer class="bg-white border-t border-gray-200 mt-10">
    <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-4 gap-8">

        <!-- About -->
        <div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded bg-blue-600 text-white flex items-center justify-center font-bold">
                    JP
                </div>
                <span class="font-semibold text-gray-800">Job Platform</span>
            </div>
            <p class="mt-4 text-sm text-gray-600">
                Helping you find the right job and advance your career with ease and professionalism.
            </p>
        </div>

        <!-- Company -->
        <div>
            <h4 class="font-semibold text-gray-900 mb-3">Company</h4>
            <ul class="space-y-2 text-sm text-gray-600">
                <li><a href="#" class="hover:text-blue-600">About Us</a></li>
                <li><a href="#" class="hover:text-blue-600">Careers</a></li>
                <li><a href="#" class="hover:text-blue-600">Blog</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h4 class="font-semibold text-gray-900 mb-3">Contact Us</h4>
            <ul class="space-y-3 text-sm text-gray-600">

                <!-- Phone -->
                <li class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.515l.516 2.064a2 2 0 01-.45 1.84l-1.27 1.27a16.06 16.06 0 006.586 6.586l1.27-1.27a2 2 0 011.84-.45l2.064.516A2 2 0 0121 16.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>+970 563000 0000</span>
                </li>

                <!-- Email -->
                <li class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 8l9 6 9-6M21 8v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8"/>
                    </svg>
                    <a href="mailto:info@jobplatform.com" class="hover:text-blue-600">
                        info@jobplatform.com
                    </a>
                </li>

                <!-- Location -->
                <li class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
                        <circle cx="12" cy="11" r="2.5"/>
                    </svg>
                    <span>ramallah</span>
                </li>

            </ul>
        </div>

        <!-- Social -->
        <div>
            <h4 class="font-semibold text-gray-900 mb-3">Follow Us</h4>
            <div class="flex gap-3">

                <!-- Facebook -->
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-100 text-gray-600 hover:text-blue-600 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12a10 10 0 10-11.5 9.9v-7H7.9V12h2.6V9.8c0-2.6 1.5-4 3.9-4 1.1 0 2.3.2 2.3.2v2.5h-1.3c-1.3 0-1.7.8-1.7 1.6V12h2.9l-.5 2.9h-2.4v7A10 10 0 0022 12z"/>
                    </svg>
                </a>

                <!-- Twitter -->
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-100 text-gray-600 hover:text-blue-600 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 5.8c-.7.3-1.5.6-2.3.7.8-.5 1.4-1.2 1.7-2.1-.8.5-1.7.9-2.6 1.1A4.1 4.1 0 0016 4c-2.3 0-4.1 1.9-4.1 4.2 0 .3 0 .6.1.9-3.4-.2-6.5-1.8-8.5-4.2-.4.6-.6 1.2-.6 2 0 1.4.7 2.7 1.8 3.4-.6 0-1.2-.2-1.7-.5 0 2 1.4 3.7 3.2 4.1-.3.1-.7.1-1 .1-.2 0-.5 0-.7-.1.5 1.7 2 3 3.8 3-1.4 1.1-3.2 1.8-5.1 1.8H2c1.8 1.2 4 1.9 6.3 1.9 7.6 0 11.8-6.4 11.8-11.9v-.5c.8-.6 1.4-1.2 1.9-2z"/>
                    </svg>
                </a>

                <!-- LinkedIn -->
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-100 text-gray-600 hover:text-blue-600 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.98 3.5C4.98 4.88 3.86 6 2.49 6S0 4.88 0 3.5 1.12 1 2.49 1s2.49 1.12 2.49 2.5zM.5 8h4V24h-4V8zm7.5 0h3.6v2.2h.1c.5-1 1.8-2.2 3.7-2.2 4 0 4.7 2.6 4.7 6V24h-4v-7.5c0-1.8 0-4.2-2.6-4.2-2.6 0-3 2-3 4.1V24h-4V8z"/>
                    </svg>
                </a>

                <!-- Instagram -->
                <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-100 text-gray-600 hover:text-blue-600 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10zm-5 3.5A5.5 5.5 0 106.5 13 5.5 5.5 0 0012 7.5zm0 2A3.5 3.5 0 118.5 13 3.5 3.5 0 0112 9.5zm4.8-.9a1.3 1.3 0 11-2.6 0 1.3 1.3 0 012.6 0z"/>
                    </svg>
                </a>

            </div>
        </div>

    </div>

    <!-- Bottom -->
    <div class="border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4 text-sm text-gray-500 flex flex-col md:flex-row justify-between items-center gap-2">
            <p>© {{ date('Y') }} Job Platform. All rights reserved.</p>
            <div class="flex gap-4">
                <a href="#" class="hover:text-blue-600">Terms</a>
                <a href="#" class="hover:text-blue-600">Privacy</a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
