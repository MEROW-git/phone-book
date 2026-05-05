@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'min-h-11 rounded-lg border-slate-300 bg-white px-3 py-2 text-base text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder-slate-500 sm:text-sm']) }}>
