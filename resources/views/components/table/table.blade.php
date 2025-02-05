@props([
    'title' => '',
    'subtitle' => '',
    'primaryBtnLink' => '',
    'primaryBtnText' => '',
    'secondaryBtnLink' => '',
    'secondaryBtnText' => '',
    'pagination' => '',
    'createPermission' => '',
])

<div class="max-w-[85rem] px-4 py-5 sm:px-6 lg:px-8 mx-auto">
    <!-- Header -->
    <div class="py-2 grid gap-3 md:flex md:justify-between md:items-center">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                {{ $title }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-neutral-400">
                {{ $subtitle }}
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                @if($secondaryBtnLink)
                    <a wire:navigate class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="{{ $secondaryBtnLink }}">
                        {{ $secondaryBtnText }}
                    </a>
                @endif

                @if($primaryBtnLink)
                    @can($createPermission)
                        <a wire:navigate class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ $primaryBtnLink }}">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                            {{ $primaryBtnText }}
                        </a>
                    @endcan
                @endif
            </div>
        </div>
    </div>
    <!-- End Header -->

    <!-- Card -->
    <div {{ $attributes }} class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 whitespace-nowrap">
                        <thead class="bg-gray-50 dark:bg-neutral-800">
                            {{ $thead }}
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            {{ $tbody }}
                        </tbody>
                    </table>
                    <!-- End Table -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->

    <!-- Footer -->
    <div class="py-4">
        {{ optional($pagination)->links('vendor.livewire.simple-tailwind') }}
    </div>
    <!-- End Footer -->
</div>
