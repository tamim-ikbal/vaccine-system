@props([
    'variant' => 'default',
    'rounded' =>'base',
    'size' => 'base'
])

<span
    @class([
    'px-2.5 py-0.5 font-medium',
    'rounded'=> $rounded === 'base',
    'rounded-full' => $rounded === 'full',
    'text-xs'=> $size === 'sm',
    'text-sm'=> $size === 'base',
    'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' => $variant === 'default',
    'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' => $variant === 'dark',
    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' => $variant === 'danger',
    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $variant === 'success',
    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300' => $variant === 'info',
    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' => $variant === 'warning',
])
>
    {{ $slot }}
</span>

