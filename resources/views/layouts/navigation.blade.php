<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16">
            <!-- Left side -->
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 shrink-0">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        JP
                    </div>
                    <span class="text-lg font-semibold text-gray-900">Job Platform</span>
                </a>

                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                        Dashboard
                    </a>

                    @auth
                        @if(auth()->user()->role === 'candidate')
                            <a href="{{ route('candidate.jobs.index') }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                                Jobs
                            </a>

                            <a href="{{ route('candidate.applications.index') }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                                Applications
                            </a>
                        @elseif(auth()->user()->role === 'employer')
                            <a href="{{ route('employer.job-posts.index') }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                                Job Posts
                            </a>

                            <a href="{{ route('employer.applications.index') }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                                Applications
                            </a>
                        @elseif(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.users.index') }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                                Users
                            </a>

                            <a href="{{ route('admin.job-posts.index') }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                                Job Posts
                            </a>

                            <a href="{{ route('admin.job-categories.index') }}"
                               class="px-4 py-2 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                                Categories
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right side desktop -->
            <div class="hidden md:flex items-center gap-4">
                

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 px-3 py-2 rounded-full border border-gray-200 bg-white hover:bg-gray-50 transition">
                            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="text-left">
                                <div class="text-sm font-semibold text-gray-900 leading-tight">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 leading-tight">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>

                            <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="py-2">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile Settings
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden border-t border-gray-200 bg-white">
        <div class="px-6 py-4 space-y-2">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                Dashboard
            </a>

            @auth
                @if(auth()->user()->role === 'candidate')
                    <a href="{{ route('candidate.jobs.index') }}"
                       class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Jobs
                    </a>

                    <a href="{{ route('candidate.applications.index') }}"
                       class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Applications
                    </a>
                @elseif(auth()->user()->role === 'employer')
                    <a href="{{ route('employer.job-posts.index') }}"
                       class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Job Posts
                    </a>

                    <a href="{{ route('employer.applications.index') }}"
                       class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Applications
                    </a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}"
                       class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Users
                    </a>

                    <a href="{{ route('admin.job-posts.index') }}"
                       class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Job Posts
                    </a>

                    <a href="{{ route('admin.job-categories.index') }}"
                       class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Categories
                    </a>
                @endif
            @endauth

            <a href="{{ route('profile.edit') }}"
               class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100">
                Profile
            </a>
        </div>

        <div class="border-t border-gray-200 px-6 py-4">
            <div class="text-base font-semibold text-gray-900">{{ Auth::user()->name }}</div>
            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>

            <div class="mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
