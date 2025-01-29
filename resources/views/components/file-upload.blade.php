@props(['error' => '', 'label' => 'Choose avatar'])

<div
     x-data="{ uploading: false, progress: 0 }"
     x-on:livewire-upload-start="uploading = true"
     x-on:livewire-upload-finish="uploading = false"
     x-on:livewire-upload-cancel="uploading = false"
     x-on:livewire-upload-error="uploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    <label class="block text-sm font-medium mb-2 dark:text-white capitalize" for="file-input">{{ $label }}</label>

    <input {{ $attributes->merge(['type' => 'file', 'class' => 'block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4 dark:file:bg-neutral-700 dark:file:text-neutral-400']) }}>

    <x-validation-error :error="$error"/>


    <!-- Progress -->
    <div x-show="uploading" class="mt-2">
        <div class="mb-2 flex justify-between items-center">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Uploading...</h3>
            <span class="text-sm text-gray-800 dark:text-white" x-text="progress + '%'"></span>
        </div>
        <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500 dark:bg-blue-500" :style="{ width: progress + '%' }"></div>
        </div>
    </div>
    <!-- End Progress -->

    <!-- Progress Bar -->
{{--    <div x-show="uploading">--}}
{{--        <!-- Progress -->--}}
{{--        <div--}}
{{--                class="flex w-full h-4 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700 mt-2"--}}
{{--                role="progressbar"--}}
{{--                aria-valuenow="25"--}}
{{--                aria-valuemin="0"--}}
{{--                aria-valuemax="100"--}}
{{--        >--}}
{{--            <div--}}
{{--                    class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap dark:bg-blue-500 transition duration-500"--}}
{{--                    :style="{ width: progress + '%' }"--}}
{{--                    x-text="progress + '%'"--}}
{{--            ></div>--}}

{{--            <progress class="w-full" max="100" x-bind:value="progress"></progress>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    <div wire:loading wire:target="{{ $error }}" class="text-sm font-semibold text-green-500">Uploading...</div>--}}
</div>
