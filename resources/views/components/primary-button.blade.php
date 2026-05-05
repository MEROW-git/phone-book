<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-lg border border-transparent bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-slate-900']) }}>
    {{ $slot }}
</button>
