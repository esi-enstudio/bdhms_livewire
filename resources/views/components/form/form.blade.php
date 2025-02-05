@props([
        'heading' => '',
        'subheading' => '',
        'cancelBtnUrl' => '#',
        'cancelBtnText' => '',
        'submitMethod' => 'store',
        'action' => [],
        'deleteId' => '',
        'name' => '',
        'deletePermission' => '',
        'editPermission' => '',
       ])

<!-- Card Section -->
<div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Card -->
    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-900">
        @if($heading || $subheading)
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-neutral-200">
                    {{ $name != '' ? $name. ' Details' : $heading }}
                </h2>
                <p class="font-semibold text-sm text-gray-600 dark:text-neutral-400">
                    {{ $subheading }}
                </p>
            </div>
        @endif

        <form wire:submit.prevent="{{ $submitMethod }}" autocomplete="on">

            {{ $slot }}

            <div class="mt-5 flex items-center justify-between">

                @if($action->btnText == 'Edit')
                    @can($deletePermission)
                        <button wire:confirm="Are you sure to delete this record?" wire:click="destroy({{ $deleteId }})" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                            Delete
                        </button>
                    @else
                        <div></div>
                    @endcan
                @else
                    <div></div>
                @endif

                <div class="flex justify-end gap-x-2">
                    <!-- Cancel Button -->
                    <a wire:navigate href="{{ $cancelBtnUrl }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        {{ $cancelBtnText }}
                    </a>
                    <!-- End Cancel Button -->

                    <!-- Action Button -->
                    @switch($action->btnType)
                        @case('button')
                            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                <span wire:loading.remove wire:target="{{ $submitMethod }}">{{ $action->btnText }}</span>
                                <span wire:loading wire:target="{{ $submitMethod }}">
                                    @switch($submitMethod)
                                        @case('store')
                                            Creating...
                                        @break

                                        @case('update')
                                            Saving...
                                        @break

                                        @case('import')
                                            Importing...
                                        @break
                                    @endswitch
                                </span>
                            </button>
                        @break


                        @case('link')
                            @can($editPermission)
                            <a wire:navigate href="{{ $action->url }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                {{ $action->btnText }}
                            </a>
                            @endcan
                        @break

                    @endswitch
                    <!-- End Action Button -->
                </div>
            </div>

        </form>
    </div>
    <!-- End Card -->
</div>
<!-- End Card Section -->
