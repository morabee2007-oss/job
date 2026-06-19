<x-app-layout>
    <div class="min-h-screen bg-[#f3f2ef] py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Candidate Dashboard</h1>
                <p class="mt-2 text-gray-600">
                    Manage your job search, applications, and profile from one place.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <a href="{{ route('candidate.jobs.index') }}"
                   class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-blue-200 transition block">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">
                        J
                    </div>
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">Browse Jobs</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Explore available opportunities and find your next role.
                    </p>
                </a>

                <a href="{{ route('candidate.applications.index') }}"
                   class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-green-200 transition block">
                    <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center font-bold text-lg">
                        A
                    </div>
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">My Applications</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Track the jobs you applied for and view their status.
                    </p>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-purple-200 transition block">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-lg">
                        P
                    </div>
                    <h2 class="mt-4 text-xl font-semibold text-gray-900">Edit Profile / Upload CV</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Update your personal details and keep your CV ready.
                    </p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
