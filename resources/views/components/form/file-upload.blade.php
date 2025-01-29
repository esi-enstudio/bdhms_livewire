@props(['error' => ''])


<div
    x-data="{ uploading: false, progress: 0 }"
    x-on:livewire-upload-start="uploading = true"
    x-on:livewire-upload-finish="uploading = false"
    x-on:livewire-upload-cancel="uploading = false"
    x-on:livewire-upload-error="uploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
    class="sm:col-span-9"
>
    <label for="af-submit-application-resume-cv" class="sr-only">Choose file</label>
    <input {{ $attributes->merge(['class' => 'block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
            file:bg-gray-50 file:border-0
            file:bg-gray-100 file:me-4
            file:py-2 file:px-4
            dark:file:bg-neutral-700 dark:file:text-neutral-400']) }} type="file">

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
</div>
