<x-guest-layout>
    <div class="min-h-screen bg-[#f3f2ef] flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-6xl grid lg:grid-cols-2 bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-200">

            <!-- Left Side -->
            <div class="hidden lg:flex flex-col justify-center bg-gradient-to-br from-blue-600 to-blue-800 text-white p-12">
                <div class="max-w-md">
                    <div class="w-14 h-14 rounded-2xl bg-white text-blue-700 flex items-center justify-center text-2xl font-bold shadow-md">
                        JP
                    </div>

                    <h1 class="mt-6 text-4xl font-bold leading-tight">
                        Start your journey with Job Platform
                    </h1>

                    <p class="mt-4 text-blue-100 text-lg leading-relaxed">
                        Create your account to discover jobs, connect with opportunities, and build your future.
                    </p>

                    <div class="mt-10 space-y-4">
                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <p class="font-semibold">For candidates</p>
                            <p class="text-sm text-blue-100 mt-1">Browse jobs, apply quickly, and manage applications.</p>
                        </div>

                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <p class="font-semibold">For employers</p>
                            <p class="text-sm text-blue-100 mt-1">Post jobs and reach the right talent faster.</p>
                        </div>

                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <p class="font-semibold">Clean and simple</p>
                            <p class="text-sm text-blue-100 mt-1">A modern experience inspired by professional job platforms.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="p-8 sm:p-10 lg:p-12">
                <div class="max-w-md mx-auto w-full">
                    <div class="lg:hidden flex items-center gap-3 mb-8">
                        <div class="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg">
                            JP
                        </div>
                        <span class="text-2xl font-bold text-gray-900">Job Platform</span>
                    </div>

                    <h2 class="text-3xl font-bold text-gray-900">Create account</h2>
                    <p class="mt-2 text-gray-600">
                        Join as a candidate or employer and get started today.
                    </p>

                    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" class="text-sm font-medium text-gray-700" />
                            <x-text-input
                                id="name"
                                class="block mt-2 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-3"
                                type="text"
                                name="name"
                                :value="old('name')"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Enter your full name"
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                            <x-text-input
                                id="email"
                                class="block mt-2 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-3"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autocomplete="username"
                                placeholder="Enter your email"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Role -->
                        <div>
                            <x-input-label for="role" :value="__('Register As')" class="text-sm font-medium text-gray-700" />
                            <select
                                id="role"
                                name="role"
                                class="block mt-2 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-3 shadow-sm"
                                required
                            >
                                <option value="">Select role</option>
                                <option value="candidate" {{ old('role') == 'candidate' ? 'selected' : '' }}>Candidate</option>
                                <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                            <x-text-input
                                id="password"
                                class="block mt-2 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-3"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Create a password"
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-gray-700" />
                            <x-text-input
                                id="password_confirmation"
                                class="block mt-2 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-4 py-3"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Confirm your password"
                            />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Submit -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 rounded-full transition shadow-sm"
                            >
                                Register
                            </button>
                        </div>

                        <!-- Login -->
                        <p class="text-sm text-center text-gray-600 pt-2">
                            Already registered?
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                Sign in
                            </a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
