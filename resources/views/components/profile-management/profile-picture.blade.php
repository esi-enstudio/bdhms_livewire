@props(['error' => '','preview','isFileUpload' => true, 'resetField' => ''])

<div
        x-data="{ uploading: false, progress: 0 }"
        x-on:livewire-upload-start="uploading = true"
        x-on:livewire-upload-finish="uploading = false"
        x-on:livewire-upload-cancel="uploading = false"
        x-on:livewire-upload-error="uploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
        class="sm:col-span-9"
>
    <div class="flex items-center gap-5">
        <!-- Image Preview -->
        <div class="mt-2">
            <img class="inline-block size-16 rounded-full ring-2 ring-white dark:ring-neutral-900 object-cover" src="{{ $preview }}" alt="Avatar">
            <x-validation-error :error="$error"/>
        </div>

        @if($isFileUpload)
            <div class="flex gap-x-2">
                <div>
                    <button onclick="document.getElementById('profilePicture').click()" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        <span>{{ $fileName }}</span>
                    </button>

                    <button wire:click="{{ $resetField }}" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-red-200 bg-white text-gray-800 shadow-sm hover:bg-red-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-red-50 dark:bg-transparent dark:border-red-700 dark:text-neutral-300 dark:hover:bg-red-800 dark:focus:bg-red-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-ccw shrink-0 size-4"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>
                    </button>
                    <input {{ $attributes->merge(['type' => 'file', 'id' => 'profilePicture']) }} class="hidden">
                </div>
            </div>
        @endif

    </div>

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
<!-- End Col -->
