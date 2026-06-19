<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Candidate Profile</h2>
        <p class="mt-1 text-sm text-gray-600">
            Update your candidate profile information and upload your CV.
        </p>
    </header>

    <form method="post" action="{{ route('profile.extra.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="date_of_birth" value="Date of Birth" />
            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full"
                :value="old('date_of_birth', optional($candidateProfile?->date_of_birth)->format('Y-m-d'))" />
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>

        <div>
            <x-input-label for="gender" value="Gender" />
            <x-text-input id="gender" name="gender" type="text" class="mt-1 block w-full"
                :value="old('gender', $candidateProfile?->gender)" />
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="address" value="Address" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                :value="old('address', $candidateProfile?->address)" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="years_of_experience" value="Years of Experience" />
            <x-text-input id="years_of_experience" name="years_of_experience" type="number" class="mt-1 block w-full"
                :value="old('years_of_experience', $candidateProfile?->years_of_experience)" />
            <x-input-error class="mt-2" :messages="$errors->get('years_of_experience')" />
        </div>

        <div>
            <x-input-label for="bio" value="Bio" />
            <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('bio', $candidateProfile?->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div>
            <x-input-label for="cv" value="CV" />
            <input id="cv" name="cv" type="file" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('cv')" />

            @if($candidateProfile?->cv)
                <p class="mt-2 text-sm">
                    Current CV:
                    <a href="{{ asset('storage/' . $candidateProfile->cv) }}" target="_blank" class="text-blue-600 underline">View CV</a>
                </p>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>

            @if (session('status') === 'extra-profile-updated')
                <p class="text-sm text-gray-600">Saved.</p>
            @endif
        </div>
    </form>
</section>
