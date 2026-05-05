<nav x-data="{ open: false }" class="sticky top-0 z-30 border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="{{ route('contacts.index') }}" class="flex items-center gap-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white">
                        <x-application-logo class="h-6 w-6" />
                    </span>
                    <span class="text-lg font-bold text-slate-900 dark:text-slate-100">Phone Book</span>
                </a>

                <div class="hidden items-center gap-1 sm:flex">
                    <a href="{{ route('contacts.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('contacts.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}">
                        Contacts
                    </a>
                    <a href="{{ route('profile.edit') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('profile.edit') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100' }}">
                        Profile
                    </a>
                </div>
            </div>

            <div class="hidden items-center gap-3 sm:flex">
                <button
                    type="button"
                    class="inline-flex h-9 items-center rounded-lg border border-slate-300 bg-white px-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800 dark:focus:ring-offset-slate-900"
                    onclick="toggleTheme()"
                    aria-label="Toggle dark mode"
                >
                    <span data-theme-label>Light</span>
                </button>

                <div class="text-sm font-medium text-slate-700 dark:text-slate-200">
                    {{ Auth::user()->name }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex h-9 items-center rounded-lg bg-slate-900 px-3 text-sm font-medium text-white transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-slate-100 dark:text-slate-900 dark:hover:bg-white dark:focus:ring-offset-slate-900">
                        Logout
                    </button>
                </form>
            </div>

            <button @click="open = ! open" class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-300 bg-white text-slate-600 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800 sm:hidden">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-slate-200 bg-white px-4 py-4 dark:border-slate-800 dark:bg-slate-900 sm:hidden">
        <div class="space-y-2">
            <a href="{{ route('contacts.index') }}" class="block rounded-lg px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Contacts</a>
            <a href="{{ route('profile.edit') }}" class="block rounded-lg px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">Profile</a>
            <div class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">
                Signed in as <span class="font-semibold text-slate-900 dark:text-white">{{ Auth::user()->name }}</span>
            </div>
            <button
                type="button"
                class="block w-full rounded-lg px-4 py-3 text-left text-sm font-medium text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800"
                onclick="toggleTheme()"
            >
                <span data-theme-label>Light</span>
            </button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full rounded-xl px-4 py-3 text-left text-sm font-semibold text-red-600 hover:bg-red-50 dark:text-red-300 dark:hover:bg-red-500/10">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
