@props([
    'color' => 'blue',
    'href' => '#',
    ])

<a {{ $attributes->merge(['class' => "inline-flex items-center gap-x-2 hover:underline whitespace-nowrap text-{$color}-600 dark:hover:text-{$color}-400 hover:text-{$color}-100 focus:outline-none focus:text-{$color}-700 dark:text-{$color}-500 dark:focus:text-{$color}-400"]) }} href="{{ $href }}" wire:navigate>
    {{ $slot }}
</a>
