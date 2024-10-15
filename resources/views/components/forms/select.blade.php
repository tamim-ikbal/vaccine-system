@props([
    'type' => 'text',
    'name' => '',
    'label' => '',
    'showError' => true,
    'value' => '',
    'text' => '',
    'rootClass' => ''
])
<div {{ $rootClass ? 'class='.$rootClass : '' }}>
    @if($label)
        <x-forms.label :for="$name">
            {{ $label }}
        </x-forms.label>
    @endif
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge(['class'=>'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'])  }}>
        {{ $slot }}
    </select>
    @if($text)
        <x-forms.text>
            {{ $text }}
        </x-forms.text>
    @endif
    @if($showError)
        <x-forms.error :name="$name"/>
    @endif
</div>
