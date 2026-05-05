<x-app-layout>
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Edit Contact</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update contact details and phone numbers.</p>
            </div>

            <a href="{{ route('contacts.index') }}" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                Back
            </a>
        </div>

        <form method="POST" action="{{ route('contacts.update', $contact) }}" class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            @csrf
            @method('PUT')

            @include('contacts._form')

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('contacts.index') }}" class="inline-flex justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                    Update Contact
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
