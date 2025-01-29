@props(['inputs' => [], 'error'])

<div class="sm:col-span-9">
    <div class="space-y-2">
        @foreach($inputs as $input)
            <input
                wire:model.blur="{{ $input['model'] }}"
                placeholder="{{ $input['placeholder'] }}"
                type="{{ $input['type'] }}"
                {{ $attributes->merge(['class' => 'py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600']) }}
            >

            <x-validation-error :error="$input['error']"/>
        @endforeach
    </div>
</div>
