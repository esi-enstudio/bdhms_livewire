<div>
    <x-form
        :name="$retailerName"
        heading="Retailer Detail's"
        subheading="Review and update the specific details of the Retailer as needed."
        :cancelBtnUrl="route('retailer.index')"
        cancelBtnText="Cancel"
        :deleteId="$form->id"
        :action=" (object) [
                'btnType' => 'link',
                'url' => route('retailer.edit', $form->id), // required if button type is 'link'
                'btnText' => 'Edit',
            ]"
    >

        <x-form.section title="Assign House and User">
            <x-form.label>House</x-form.label>
            <x-form.select-input-sm wire:model.live="form.house_id" error="form.house_id" disabled>
                <option selected="" value="">Select House</option>
                @forelse($this->houses as $house)
                    <option value="{{ $house->id }}">{{ $house->code.'-'.$house->name }}</option>
                @empty
                    <option>No data found</option>
                @endforelse
            </x-form.select-input-sm>

            <x-form.label>User</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.user_id" error="form.user_id" disabled>
                <option selected="" value="">Select User</option>
                @forelse($this->users as $user)
                    <option value="{{ $user->id }}">{{ $user->phone.'-'.$user->name }}</option>
                @empty
                    <option>No data found</option>
                @endforelse
            </x-form.select-input-sm>
        </x-form.section>

        <x-form.section title="Retailer Information">
            <x-form.label>Code</x-form.label>
            <x-form.text-input wire:model.blur="form.code" error="form.code" placeholder="Enter retailer code" readonly/>

            <x-form.label>name</x-form.label>
            <x-form.text-input wire:model.blur="form.name" error="form.name" placeholder="Enter retailer name" readonly/>

            <x-form.label>type</x-form.label>
            <x-form.text-input wire:model.blur="form.type" error="form.type" placeholder="Enter type" readonly/>

            <x-form.label>enabled</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.enabled" error="form.enabled" disabled>
                <option selected="" value="">Select Status</option>
                <option value="Y">Enabled</option>
                <option value="N">Disabled</option>
            </x-form.select-input-sm>

            <x-form.label>service point</x-form.label>
            <x-form.text-input wire:model.blur="form.service_point" error="form.service_point" placeholder="Enter service point" readonly/>

            <x-form.label>category</x-form.label>
            <x-form.text-input wire:model.blur="form.category" error="form.category" placeholder="Enter category" readonly/>
        </x-form.section>

        <x-form.section title="User/Owner Information">
            <x-form.label>owner name</x-form.label>
            <x-form.text-input wire:model.blur="form.owner_name" error="form.owner_name" placeholder="Enter owner name" readonly/>

            <x-form.label>owner number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.owner_number" error="form.owner_number" placeholder="Enter owner number" readonly/>

            <x-form.label>itop number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.itop_number" error="form.itop_number" placeholder="Enter itop number" readonly/>

            <x-form.label>date of birth</x-form.label>
            <x-form.text-input type="date" wire:model.blur="form.dob" error="form.dob" readonly/>

            <x-form.label>nid</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.nid" error="form.nid" placeholder="Enter nid number" readonly/>
        </x-form.section>

        <x-form.section title="Location Information">
            <x-form.label>division</x-form.label>
            <x-form.text-input wire:model.blur="form.division" error="form.division" placeholder="Enter division" readonly/>

            <x-form.label>district</x-form.label>
            <x-form.text-input wire:model.blur="form.district" error="form.district" placeholder="Enter district" readonly/>

            <x-form.label>thana</x-form.label>
            <x-form.text-input wire:model.blur="form.thana" error="form.thana" placeholder="Enter thana" readonly/>

            <x-form.label>address</x-form.label>
            <x-form.text-input wire:model.blur="form.address" error="form.address" placeholder="Enter address" readonly/>

            <x-form.label>latitude</x-form.label>
            <x-form.text-input wire:model.blur="form.lat" error="form.lat" placeholder="Enter latitude" readonly/>

            <x-form.label>longitude</x-form.label>
            <x-form.text-input wire:model.blur="form.long" error="form.long" placeholder="Enter longitude" readonly/>
        </x-form.section>

        <x-form.section title="Technical Information">
            <x-form.label>sso</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.sso" error="form.sso" disabled>
                <option selected="" value="">Select SSO</option>
                <option value="Y">Enabled</option>
                <option value="N">Disabled</option>
            </x-form.select-input-sm>

            <x-form.label>bts code</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.bts_code" error="form.bts_code" disabled>
                <option selected="" value="">Select BTS Code</option>
                <option value="DHK5487">DHK5487</option>
            </x-form.select-input-sm>
        </x-form.section>

        <x-form.section title="Additional Information">
            <x-form.label>description</x-form.label>
            <x-form.text-input wire:model.blur="form.description" error="form.description" placeholder="Enter description" readonly/>

            <x-form.label>remarks</x-form.label>
            <x-form.text-input wire:model.blur="form.remarks" error="form.remarks" placeholder="Enter remarks" readonly/>

            <x-form.label>Document</x-form.label>
            <div class="sm:col-span-9">
                <div class="space-y-2">
                    @if($document)
                        <button
                            class="flex items-center text-sm text-gray-600 dark:text-neutral-400 hover:text-green-500 hover:underline font-semibold"
                            type="button" wire:click="download({{ $form->id }})">
                            Download Attachment
                            <x-icon.paperclip/>
                        </button>
                    @else
                        No attachment found.
                    @endif
                </div>
            </div>
        </x-form.section>

    </x-form>
</div>
