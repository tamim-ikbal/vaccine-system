@props([
    'active' => false,
    'class' => '',
    'href' => '#'
])
<a
    href="{{ $href }}"
    @class([
'block py-2 px-3 rounded md:p-0 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:text-white',
'text-gray-900' => !$active,
'text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:dark:text-blue-500' => $active
])
    {{ $attributes }}
>
    {{ $slot }}
</a>
