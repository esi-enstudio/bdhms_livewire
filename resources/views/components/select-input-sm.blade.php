@props(['error' => '', 'label' => 'Define Label'])

<div class="sm:col-span-9">
    <select {{ $attributes->merge(['class' => 'py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600']) }}>
        <option selected="" value="">{{ $label }}</option>
        {{ $slot }}
    </select>

    <x-validation-error :error="$error"/>
</div>
