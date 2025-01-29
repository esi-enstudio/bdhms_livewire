@props(['show' => false, 'edit' => false, 'create' => false, 'id'])

<!-- Card Section -->
<div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
{{--    <x-validation-errors/>--}}
    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-800">
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                {{ $title }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-neutral-400">
                {{ $subtitle }}
            </p>
        </div>

        <form wire:submit.prevent="{{ $create ? 'store' : ($edit ? 'update' : '') }}">
            <!-- Grid -->
            <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                {{ $slot }}
            </div>
            <!-- End Grid -->

            <div class="mt-5 flex justify-end gap-x-2">
                <a href="{{ route('user.index') }}" wire:navigate class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                    Cancel
                </a>

                @if($create)
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span wire:loading.remove wire:target="store">Create User</span>
                        <span wire:loading wire:target="store">Creating...</span>
                    </button>
                @endif

                @if($edit)
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <span wire:loading.remove wire:target="update">Save Changes</span>
                        <span wire:loading wire:target="update">Saving...</span>
                    </button>
                @endif

                @if($show)
                    <a href="{{ route('user.edit', $id) }}" wire:navigate class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Edit
                    </a>
                @endif
            </div>
        </form>
    </div>
    <!-- End Card -->
</div>
<!-- End Card Section -->
