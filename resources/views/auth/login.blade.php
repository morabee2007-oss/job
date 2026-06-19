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
                        Welcome back to Job Platform
                    </h1>

                    <p class="mt-4 text-blue-100 text-lg leading-relaxed">
                        Sign in to explore opportunities, manage your applications, and continue your career journey.
                    </p>

                    <div class="mt-10 space-y-4">
                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <p class="font-semibold">Discover jobs faster</p>
                            <p class="text-sm text-blue-100 mt-1">Search by title, category, and location.</p>
                        </div>

                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <p class="font-semibold">Apply with confidence</p>
                            <p class="text-sm text-blue-100 mt-1">View detailed job posts before applying.</p>
                        </div>

                        <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                            <p class="font-semibold">Track your progress</p>
                            <p class="text-sm text-blue-100 mt-1">Keep an eye on your applications in one place.</p>
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

                    <h2 class="text-3xl font-bold text-gray-900">Sign in</h2>
                    <p class="mt-2 text-gray-600">
                        Access your account and continue where you left off.
                    </p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mt-6 mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                        @csrf

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
                                autofocus
                                autocomplete="username"
                                placeholder="Enter your email"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
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
                                autocomplete="current-password"
                                placeholder="Enter your password"
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember / Forgot -->
                        <div class="flex items-center justify-between gap-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                    name="remember"
                                >
                                <span class="ms-2 text-sm text-gray-600">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a
                                    class="text-sm text-blue-600 hover:text-blue-700 font-medium"
                                    href="{{ route('password.request') }}"
                                >
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 rounded-full transition shadow-sm"
                            >
                                Log in
                            </button>
                        </div>

                        <!-- Register -->
                        <p class="text-sm text-center text-gray-600 pt-2">
                            Don’t have an account?
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                Create one
                            </a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
