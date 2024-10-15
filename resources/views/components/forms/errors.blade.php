@props([
    'title' => __('Errors:'),
    'errors' => []
])
<div>
    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
        {{ $title }}
    </h3>
    <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
        @foreach($errors as $error)
            <li class="flex items-center text-red-600 dark:text-red-500">
                <svg class="w-4 h-4 me-2 flex-shrink-0 text-red-600 dark:text-red-500" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                          d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                          clip-rule="evenodd"/>
                </svg>
                At least 10 characters
            </li>
        @endforeach
    </ul>
</div>
