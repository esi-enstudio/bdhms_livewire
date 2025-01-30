@props(['color' => 'blue'])

<button type="button" {{ $attributes }} class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-{{$color}}-600 hover:text-{{$color}}-800 focus:outline-none focus:text-{{$color}}-800 disabled:opacity-50 disabled:pointer-events-none dark:text-{{$color}}-500 dark:hover:text-{{$color}}-400 dark:focus:text-{{$color}}-400">
    {{ $slot }}
</button>