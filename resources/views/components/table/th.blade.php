@props(['checkbox' => false])

@if($checkbox)
    <th scope="col" class="ps-6 py-3 text-start">
        <label class="flex">
            <input type="checkbox" {{ $attributes->merge(['class' => 'shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800']) }}>
            <span class="sr-only">Checkbox</span>
        </label>
    </th>
@else
    <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
        <div class="flex items-center gap-x-2">
        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
          {{ $slot }}
        </span>
        </div>
    </th>
@endif
