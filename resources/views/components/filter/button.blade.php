@props(['data' => [],'label' => 'Button', 'action','message'])

<button type="button" {{ $attributes->class([
    'w-full flex items-center justify-between gap-x-3.5 py-2 px-3 rounded-lg text-sm hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700',
    'text-gray-300 cursor-not-allowed dark:hover:text-neutral-600 dark:text-neutral-700' => count($data) < 1,
    'text-gray-800 dark:hover:text-neutral-300 dark:text-neutral-400' => count($data) > 0,
    ]) }}

{{ count($data) < 1 ? 'disabled' : '' }}
>
    {{ $label }}
    <span>({{ count($data) }})</span>
</button>
