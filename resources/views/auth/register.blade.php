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
                <h2 class="text-xl font-bold text-slate-950 dark:text-white">Create your account</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Start managing family contacts securely.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="mt-2 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="mt-2 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900">
                    {{ __('Register') }}
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500 dark:text-slate-400">
                Already registered?
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-800 dark:text-indigo-300 dark:hover:text-indigo-200">Log in</a>
            </p>
        </div>
    </div>
</x-guest-layout>
