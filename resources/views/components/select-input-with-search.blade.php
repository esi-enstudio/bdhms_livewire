@props(['error' => '', 'label' => 'Define Label'])

{{--<div class="sm:col-span-9">--}}
{{--    <select {{ $attributes->merge(['class' => 'py-2 px-3 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600']) }}>--}}
{{--        <option selected="" value="">{{ $label }}</option>--}}
{{--        {{ $slot }}--}}
{{--    </select>--}}

{{--    <x-validation-error :error="$error"/>--}}
{{--</div>--}}


<div class="sm:col-span-9">
    <div wire:ignore>
        <!-- Select -->
        <select data-hs-select='{
  "hasSearch": true,
  "minSearchLength": 3,
  "searchPlaceholder": "Search...",
  "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
  "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
  "placeholder": "Select country...",
  "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
  "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
  "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-neutral-200 \" data-title></div></div></div>",
  "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
}' class="hidden">
            <option value="">Choose</option>
            <option value="AF" data-hs-select-option='{
    "icon": "<img class=\"inline-block size-4 rounded-full\" src=\"../assets/vendor/svg-country-flags/png100px/af.png\" alt=\"Afghanistan\" />"}'>
                Afghanistan
            </option>
            <option value="AX" data-hs-select-option='{
    "icon": "<img class=\"inline-block size-4 rounded-full\" src=\"../assets/vendor/svg-country-flags/png100px/ax.png\" alt=\"Aland Islands\" />"}'>
                Aland Islands
            </option>
            <option value="AL" data-hs-select-option='{
    "icon": "<img class=\"inline-block size-4 rounded-full\" src=\"../assets/vendor/svg-country-flags/png100px/al.png\" alt=\"Albania\" />"}'>
                Albania
            </option>
        </select>
        <!-- End Select -->
    </div>



    <x-validation-error :error="$error"/>
</div>