<x-guest-layout>
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <a href="/" class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/25">
                <x-application-logo class="h-9 w-9" />
            </a>
            <h1 class="text-3xl font-black tracking-tight text-slate-950 dark:text-white">Phone Book</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Family contact manager</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-7">
                <h2 class="text-xl font-bold text-slate-950 dark:text-white">Welcome back</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Log in to view your family contacts.</p>
            </div>

            <x-auth-session-status class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:text-emerald-300" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between gap-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950" name="remember">
                        <span class="ms-2 text-sm font-medium text-slate-600 dark:text-slate-300">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-indigo-300 dark:hover:text-indigo-200 dark:focus:ring-offset-slate-900" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900">
                    {{ __('Log in') }}
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500 dark:text-slate-400">
                Need an account?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-800 dark:text-indigo-300 dark:hover:text-indigo-200">Register</a>
            </p>
        </div>
    </div>
</x-guest-layout>
