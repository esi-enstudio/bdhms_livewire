<div>
    <x-form
        heading="Make a Request"
        subheading="Fill in the details below to make a replacement request."
        :cancelBtnUrl="route('itopReplace.index')"
        cancelBtnText="Cancel"
        :action=" (object) [
                'btnType' => 'button',
                'btnText' => 'Submit Request',
            ]"
        submitMethod="store"
    >

        <x-form.section>
            <x-form.label>Retailer ({{ count($retailers) }})</x-form.label>
            <div class="sm:col-span-9">

                <div wire:ignore>
                    <div class="relative" data-hs-combo-box="">
                        <div class="relative">
                            <input wire:model="itop_number" class="py-2 ps-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" type="text" role="combobox" aria-expanded="false" value="" data-hs-combo-box-input="">
                            <div class="hidden hs-combo-box-active:flex absolute inset-y-0 end-8 items-center z-20">
                                <button type="button" class="inline-flex shrink-0 justify-center items-center size-6 rounded-full text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500" aria-label="Close" data-hs-combo-box-close="">
                                    <span class="sr-only">Close</span>
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="m15 9-6 6"></path>
                                        <path d="m9 9 6 6"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="absolute top-1/2 end-3 -translate-y-1/2" aria-expanded="false" data-hs-combo-box-toggle="">
                                <svg class="shrink-0 size-3.5 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m7 15 5 5 5-5"></path>
                                    <path d="m7 9 5-5 5 5"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="absolute z-50 w-full max-h-72 p-1 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700" style="display: none;" data-hs-combo-box-output="">

                            @foreach($retailers as $retailer)
                                <div
                                    class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800"
                                    tabindex="0"
                                    data-hs-combo-box-output-item=""
                                    data-hs-combo-box-item-stored-data='{"id": 1,"name": "Argentina"}'
                                >
                                    <div class="flex justify-between items-center w-full">
                                        <span data-hs-combo-box-search-text="{{ $retailer->itop_number }}" data-hs-combo-box-value="">{{ $retailer->code.' - '.$retailer->itop_number }}</span>
                                        <span class="hidden hs-combo-box-selected:block">
                                  <svg class="shrink-0 size-3.5 text-blue-600 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5"></path>
                                  </svg>
                                </span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>


            </div>

            <x-form.label>Sim Serial</x-form.label>
            <x-form.text-input wire:model.blur="form.sim_serial" error="form.sim_serial" placeholder="Enter sim serial"/>

            <x-form.label>Balance</x-form.label>
            <x-form.text-input wire:model.blur="form.balance" error="form.balance" placeholder="Enter balance"/>

            <x-form.label>Reason</x-form.label>
            <x-form.text-input wire:model.blur="form.reason" error="form.reason" placeholder="Enter reason"/>

            <x-form.label>Remarks</x-form.label>
            <x-form.text-input wire:model.blur="form.remarks" error="form.remarks" placeholder="Enter remarks"/>

            <x-form.label>Description</x-form.label>
            <x-form.text-input wire:model.blur="form.description" error="form.description" placeholder="Enter description"/>

        </x-form.section>
    </x-form>
</div>
