<div class="relative max-w-screen-md mx-auto">
    <input {{ $attributes->merge(['type' => 'search', 'class' => 'rounded-full peer py-2 px-3 ps-14 focus:shadow-md block w-full bg-gray-200 border-transparent focus:border-gray-200 focus:ring-transparent disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-300 dark:focus:ring-neutral-600']) }}>

    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
    </div>
</div>
