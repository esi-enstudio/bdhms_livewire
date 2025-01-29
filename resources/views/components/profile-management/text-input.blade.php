@props(['error' => ''])

<div class="sm:col-span-9">
    <input {{ $attributes->merge(['type' => 'text', 'class' => 'py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600', 'placeholder' => '']) }}>

    <x-validation-error :error="$error"/>
</div>
