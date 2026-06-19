<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $job->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-4xl mx-auto px-6 py-10">
        <a href="{{ route('home') }}" class="text-blue-600 mb-6 inline-block">← Back to jobs</a>

        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-2">{{ $job->title }}</h1>

            <p class="text-lg text-gray-700 mb-1">
                {{ $job->employer->companyProfile->company_name ?? $job->employer->name }}
            </p>

            <p class="text-gray-500">{{ $job->location ?? 'No location specified' }}</p>
            <p class="text-gray-500">{{ $job->category?->name ?? 'No category' }}</p>
            <p class="text-gray-500">{{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</p>

            @if($job->salary_min || $job->salary_max)
                <p class="mt-2 text-sm text-gray-600">
                    Salary: {{ $job->salary_min ?? '-' }} - {{ $job->salary_max ?? '-' }}
                </p>
            @endif

            @if($job->deadline)
                <p class="mt-1 text-sm text-gray-600">
                    Deadline: {{ $job->deadline->format('Y-m-d') }}
                </p>
            @endif

            <hr class="my-6">

            <div>
                <h2 class="text-xl font-semibold mb-3">Job Description</h2>
                <p class="text-gray-700 whitespace-pre-line">{{ $job->description }}</p>
            </div>

            <div class="mt-8">
                @auth
                    @if(auth()->user()->role === 'candidate')
                        <form method="POST" action="{{ route('candidate.jobs.apply', $job) }}">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded">
                                Apply Now
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-3 rounded inline-block">
                        Login to Apply
                    </a>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>
