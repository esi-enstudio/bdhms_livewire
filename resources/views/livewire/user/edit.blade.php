<div>
    <x-profile-management :edit="$isEdit">
        <x-slot:title>{{ $form->name ?? 'Name' }}</x-slot:title>
        <x-slot:subtitle>Manage your name, password and account settings.</x-slot:subtitle>

        <x-profile-management.label caption="Displayed user profile picture">Profile photo</x-profile-management.label>
        <x-profile-management.profile-picture wire:model.blur="form.avatar" error="form.avatar" :preview="$avatarPreview" :file-name="$fileName" :is-file-upload="true"/>

        <x-profile-management.label caption="">Full Name</x-profile-management.label>
        <x-profile-management.text-input wire:model.live="form.name" error="form.name" placeholder="Enter full name"/>

        <x-profile-management.label caption="">Phone Number</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.phone" error="form.phone" type="number" placeholder="Enter phone number"/>

        <x-profile-management.label caption="">Email</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.email" error="form.email" type="email" placeholder="Enter email address"/>

        <x-profile-management.label caption="">Password</x-profile-management.label>
        <x-profile-management.text-inputs :inputs="$form->passwordFields"/>

        <x-profile-management.label caption="">Role</x-profile-management.label>
        <div class="sm:col-span-9">
            <div wire:ignore class="mb-4">
                <!-- Select -->
                <select wire:model.blur="role" id="multiple-with-conditional-counter-select-role" multiple="" {{ count($roles) < 1 ? 'disabled' : '' }} data-hs-select='{
                    "placeholder": "Select Role",
                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                    "toggleSeparators": {
                      "betweenItemsAndCounter": "&"
                    },
                    "toggleCountText": "+",
                    "toggleCountTextPlacement": "prefix-no-space",
                    "toggleCountTextMinItems": 3,
                    "toggleCountTextMode": "nItemsAndCount",
                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                  }' class="hidden">
                    <option value="">Select Role</option>
                    @forelse($roles as $role)
                        <option value="{{ $role->name }}">{{ Str::title($role->name) }}</option>
                    @empty
                        <option>No roles found</option>
                    @endforelse
                </select>
                <!-- End Select -->
            </div>
            <x-validation-error error="form.role"/>

            @if(count($roles) > 0)
                <div class="flex flex-wrap gap-2">
                    <button type="button" id="multiple-with-conditional-counter-trigger-clear-role" class="py-1 px-2 inline-flex items-center gap-x-1 text-sm rounded-lg border border-red-200 bg-white text-red-800 hover:bg-red-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-red-900 dark:text-white dark:border-red-700 dark:hover:bg-red-800">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                        Clear roles
                    </button>
                </div>
            @endif
        </div>

{{--        <x-profile-management.select-input-sm wire:model.blur="form.role" error="form.role" label="Role" :options="$form->roles"/>--}}

        <x-profile-management.label caption="">Remarks</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.remarks" error="form.remarks" placeholder="Enter remarks"/>

        <x-profile-management.label caption="">Status</x-profile-management.label>
        <x-profile-management.select-input-sm wire:model.blur="form.status" error="form.status" label="Status" :options="$form->selectStatus"/>

        <x-profile-management.label caption="">Assign House</x-profile-management.label>
        <x-profile-management.checkbox-input wire:model.blur="form.houses" error="form.houses" :items="$houses"/>
    </x-profile-management>
</div>

@push('scripts')
    <script>
        window.addEventListener('load', () => {
            (function() {
                const clearBtn = document.querySelector('#multiple-with-conditional-counter-trigger-clear-role');

                clearBtn.addEventListener('click', () => {
                    const select = HSSelect.getInstance('#multiple-with-conditional-counter-select-role', true);

                    select.element.setValue([]);
                });
            })();
        });
    </script>
@endpush
