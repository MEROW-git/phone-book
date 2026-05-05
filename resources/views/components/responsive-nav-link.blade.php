@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full border-l-4 border-indigo-500 bg-indigo-50 py-2 pe-4 ps-3 text-start text-base font-medium text-indigo-700 transition duration-150 ease-in-out focus:border-indigo-700 focus:bg-indigo-100 focus:text-indigo-800 focus:outline-none dark:bg-indigo-950 dark:text-indigo-300'
            : 'block w-full border-l-4 border-transparent py-2 pe-4 ps-3 text-start text-base font-medium text-slate-600 transition duration-150 ease-in-out hover:border-slate-300 hover:bg-slate-50 hover:text-slate-800 focus:border-slate-300 focus:bg-slate-50 focus:text-slate-800 focus:outline-none dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100 dark:focus:bg-slate-800 dark:focus:text-slate-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
