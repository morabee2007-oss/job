<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('profile.partials.update-profile-information-form')
            </div>

            

            @if(auth()->user()->role === 'candidate')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    @include('profile.partials.candidate-extra-profile-form')
                </div>
            @endif

            @if(auth()->user()->role === 'employer')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    @include('profile.partials.employer-company-profile-form')
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
