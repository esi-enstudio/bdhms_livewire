@props(['error' => '', 'items' => []])

<div class="sm:col-span-9">
    <div class="space-y-2">
        @foreach($items as $item)
            <div class="flex">
                <input {{ $attributes->merge(['class' => 'shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800']) }}
                       value="{{ $item->id }}"
                       type="checkbox"
                       id="hs-default-checkbox-{{ $item->id }}">
                <label for="hs-default-checkbox-{{ $item->id }}" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $item->name }}</label>
            </div>
        @endforeach
    </div>

    <x-validation-error :error="$error"/>
</div>
