@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium leading-5 text-slate-900 transition duration-150 ease-in-out focus:border-indigo-700 focus:outline-none dark:text-slate-100'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-slate-500 transition duration-150 ease-in-out hover:border-slate-300 hover:text-slate-700 focus:border-slate-300 focus:text-slate-700 focus:outline-none dark:text-slate-400 dark:hover:text-slate-200 dark:focus:text-slate-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
