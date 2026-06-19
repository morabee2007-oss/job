<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Company Profile</h2>
        <p class="mt-1 text-sm text-gray-600">
            Update your company profile information and upload your logo.
        </p>
    </header>

    <form method="post" action="{{ route('profile.extra.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="company_name" value="Company Name" />
            <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full"
                :value="old('company_name', $companyProfile?->company_name)" />
            <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
        </div>

        <div>
            <x-input-label for="website" value="Website" />
            <x-text-input id="website" name="website" type="url" class="mt-1 block w-full"
                :value="old('website', $companyProfile?->website)" />
            <x-input-error class="mt-2" :messages="$errors->get('website')" />
        </div>

        <div>
            <x-input-label for="location" value="Location" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                :value="old('location', $companyProfile?->location)" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        <div>
            <x-input-label for="description" value="Description" />
            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $companyProfile?->description) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="logo" value="Logo" />
            <input id="logo" name="logo" type="file" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('logo')" />

            @if($companyProfile?->logo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $companyProfile->logo) }}" alt="Company Logo" class="h-20 rounded">
                </div>
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
