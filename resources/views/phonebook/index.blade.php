<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
            <div>
                <p class="text-sm font-bold uppercase tracking-wide text-indigo-600 dark:text-indigo-300">Contacts</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 dark:text-white sm:text-4xl">Family Phone Book</h1>
                <p class="mt-3 max-w-2xl text-base text-slate-600 dark:text-slate-400">A clean, secure place for family contacts, relationships, and primary phone numbers.</p>
            </div>

            <div class="relative w-full lg:max-w-sm">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
                <input type="search" placeholder="Search contacts..." class="min-h-11 w-full rounded-lg border border-slate-300 bg-white py-2 pl-12 pr-4 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500" aria-label="Search contacts">
            </div>
        </div>

        <div class="mb-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Total Contacts</p>
                <p class="mt-3 text-3xl font-black text-slate-950 dark:text-white">{{ $totalContacts }}</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Total Families</p>
                <p class="mt-3 text-3xl font-black text-slate-950 dark:text-white">{{ $totalFamilies }}</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Total Phone Numbers</p>
                <p class="mt-3 text-3xl font-black text-slate-950 dark:text-white">{{ $totalPhoneNumbers }}</p>
            </div>
        </div>

        @if ($contacts->isEmpty())
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-300">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <h2 class="mt-5 text-xl font-bold text-slate-950 dark:text-white">No contacts found</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Seed the database to see your family contacts here.</p>
            </div>
        @else
            <div class="hidden overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900 lg:block">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800">
                    <thead class="bg-slate-50 dark:bg-slate-900/80">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">Family</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">Relationship</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">Address</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">Phone Numbers</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ($contacts as $contact)
                            <tr class="transition hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                <td class="px-6 py-5">
                                    <div class="font-bold text-slate-950 dark:text-white">{{ $contact->name }}</div>
                                </td>
                                <td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-300">{{ $contact->family->name }}</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300">{{ $contact->relationship->name }}</span>
                                </td>
                                <td class="px-6 py-5 text-sm">
                                    @if ($contact->email)
                                        <a href="mailto:{{ $contact->email }}" class="font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-300 dark:hover:text-indigo-200">{{ $contact->email }}</a>
                                    @else
                                        <span class="text-slate-400 dark:text-slate-500">No email</span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-sm text-slate-600 dark:text-slate-300">{{ $contact->address ?? 'No address' }}</td>
                                <td class="px-6 py-5">
                                    <div class="flex flex-col gap-2">
                                        @foreach ($contact->phoneNumbers as $phoneNumber)
                                            <div class="flex flex-wrap items-center gap-2 text-sm">
                                                <span class="font-bold text-slate-700 dark:text-slate-200">{{ $phoneNumber->label }}</span>
                                                <span class="text-slate-600 dark:text-slate-300">{{ $phoneNumber->phone }}</span>
                                                @if ($phoneNumber->is_primary)
                                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">Primary</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="grid gap-4 lg:hidden">
                @foreach ($contacts as $contact)
                    <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-black text-slate-950 dark:text-white">{{ $contact->name }}</h2>
                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $contact->family->name }} / {{ $contact->relationship->name }}</p>
                            </div>
                            <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300">{{ $contact->relationship->name }}</span>
                        </div>

                        <dl class="mt-5 space-y-4 text-sm">
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400">Email</dt>
                                <dd class="mt-1">
                                    @if ($contact->email)
                                        <a href="mailto:{{ $contact->email }}" class="font-medium text-indigo-600 dark:text-indigo-300">{{ $contact->email }}</a>
                                    @else
                                        <span class="text-slate-400 dark:text-slate-500">No email</span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400">Address</dt>
                                <dd class="mt-1 text-slate-700 dark:text-slate-200">{{ $contact->address ?? 'No address' }}</dd>
                            </div>
                            <div>
                                <dt class="font-bold text-slate-500 dark:text-slate-400">Phone Numbers</dt>
                                <dd class="mt-2 flex flex-col gap-2">
                                    @foreach ($contact->phoneNumbers as $phoneNumber)
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="font-bold text-slate-700 dark:text-slate-200">{{ $phoneNumber->label }}</span>
                                            <span class="text-slate-600 dark:text-slate-300">{{ $phoneNumber->phone }}</span>
                                            @if ($phoneNumber->is_primary)
                                                <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">Primary</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </dd>
                            </div>
                        </dl>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
