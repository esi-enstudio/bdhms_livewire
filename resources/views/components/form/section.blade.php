@props(['title' => ''])

<!-- Section -->
<div class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
    <div class="sm:col-span-12">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
            {{ $title }}
        </h2>
    </div>
    <!-- End Col -->

    {{ $slot }}

</div>
<!-- End Section -->