<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Contacts</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage family contacts and phone numbers.</p>
            </div>

            <a href="{{ route('contacts.create') }}" class="inline-flex justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                Add Contact
            </a>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 dark:border-emerald-900 dark:bg-emerald-950 dark:text-emerald-300">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Contacts</p>
                <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $totalContacts }}</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Families</p>
                <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $totalFamilies }}</p>
            </div>
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Phone Numbers</p>
                <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $totalPhoneNumbers }}</p>
            </div>
        </div>

        <div class="mb-6">
            <label for="search" class="sr-only">Search contacts</label>
            <input id="search" type="search" placeholder="Search contacts..." class="block min-h-11 w-full rounded-lg border-slate-300 bg-white px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder-slate-500">
        </div>

        @if ($contacts->isEmpty())
            <div class="rounded-xl border border-dashed border-slate-300 bg-white p-10 text-center dark:border-slate-700 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">No contacts yet</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Add your first family contact to get started.</p>
                <a href="{{ route('contacts.create') }}" class="mt-5 inline-flex rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                    Add Contact
                </a>
            </div>
        @else
            <div class="hidden overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900 lg:block">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800">
                    <thead class="bg-slate-50 dark:bg-slate-900">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Name</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Family</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Relationship</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Email</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Address</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Phone Numbers</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="px-5 py-4 font-semibold text-slate-900 dark:text-slate-100">{{ $contact->name }}</td>
                                <td class="px-5 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $contact->family->name }}</td>
                                <td class="px-5 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $contact->relationship->name }}</td>
                                <td class="px-5 py-4 text-sm">
                                    @if ($contact->email)
                                        <a href="mailto:{{ $contact->email }}" class="text-indigo-600 hover:text-indigo-700 dark:text-indigo-300">{{ $contact->email }}</a>
                                    @else
                                        <span class="text-slate-400 dark:text-slate-500">None</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $contact->address ?? 'None' }}</td>
                                <td class="px-5 py-4">
                                    <div class="space-y-2">
                                        @foreach ($contact->phoneNumbers as $phoneNumber)
                                            <div class="flex flex-wrap items-center gap-2 text-sm">
                                                <span class="font-medium text-slate-700 dark:text-slate-200">{{ $phoneNumber->label }}</span>
                                                <span class="text-slate-600 dark:text-slate-300">{{ $phoneNumber->phone }}</span>
                                                @if ($phoneNumber->is_primary)
                                                    <span class="rounded-md bg-emerald-100 px-2 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300">Primary</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('contacts.edit', $contact) }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('contacts.destroy', $contact) }}" onsubmit="return confirm('Delete this contact?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg bg-red-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="grid gap-4 lg:hidden">
                @foreach ($contacts as $contact)
                    <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="font-semibold text-slate-900 dark:text-slate-100">{{ $contact->name }}</h2>
                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $contact->family->name }} / {{ $contact->relationship->name }}</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('contacts.edit', $contact) }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm font-medium text-slate-700 dark:border-slate-700 dark:text-slate-200">Edit</a>
                            </div>
                        </div>

                        <div class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300">
                            <p><span class="font-medium text-slate-800 dark:text-slate-100">Email:</span> {{ $contact->email ?? 'None' }}</p>
                            <p><span class="font-medium text-slate-800 dark:text-slate-100">Address:</span> {{ $contact->address ?? 'None' }}</p>
                            <div>
                                <p class="font-medium text-slate-800 dark:text-slate-100">Phone Numbers:</p>
                                <div class="mt-2 space-y-2">
                                    @foreach ($contact->phoneNumbers as $phoneNumber)
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span>{{ $phoneNumber->label }}: {{ $phoneNumber->phone }}</span>
                                            @if ($phoneNumber->is_primary)
                                                <span class="rounded-md bg-emerald-100 px-2 py-0.5 text-xs font-medium text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300">Primary</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('contacts.destroy', $contact) }}" class="mt-4" onsubmit="return confirm('Delete this contact?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
