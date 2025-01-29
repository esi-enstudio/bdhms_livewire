@props(['inputs' => []])

<div class="sm:col-span-9">
    <div class="sm:flex">
        @foreach($inputs as $input)
            <input
                    wire:model.blur="{{ $input['model'] }}"
                    type="text"
                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="{{ $input['placeholder'] }}"
            >
        @endforeach
    </div>

{{--    <x-validation-error :error="$input['placeholder']"/>--}}
</div>
