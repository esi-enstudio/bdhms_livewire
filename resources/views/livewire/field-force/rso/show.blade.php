<div>
    <x-form
        :name="$rsoName"
        heading="Rso Detail's"
        subheading="Review and update the specific details of the rso as needed."
        :cancelBtnUrl="route('rso.index')"
        cancelBtnText="Cancel"
        :deleteId="$form->rsoId"
        :action=" (object) [
                'btnType' => 'link',
                'url' => route('rso.edit', $form->rsoId), // required if button type is 'link'
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
            <x-form.select-input-sm wire:model.live="form.user_id" error="form.user_id" disabled>
                <option selected="" value="">Select User</option>
                @forelse($this->users as $user)
                    <option value="{{ $user->id }}">{{ $user->phone.'-'.$user->name }}</option>
                @empty
                    <option>No data found</option>
                @endforelse
            </x-form.select-input-sm>
        </x-form.section>

        <x-form.section title="Personal Information">
            <x-form.label>Personal Number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.personal_number" error="form.personal_number" placeholder="Enter personal number" readonly/>

            <x-form.label>father name</x-form.label>
            <x-form.text-input wire:model.blur="form.father_name" error="form.father_name" placeholder="Enter father name" readonly/>

            <x-form.label>mother name</x-form.label>
            <x-form.text-input wire:model.blur="form.mother_name" error="form.mother_name" placeholder="Enter mother name" readonly/>

            <x-form.label>date of birth</x-form.label>
            <x-form.text-input type="date" wire:model.blur="form.dob" error="form.dob" readonly/>

            <x-form.label>nid</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.nid" error="form.nid" placeholder="Enter nid number" readonly/>

            <x-form.label>religion</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.religion" error="form.religion" disabled>
                <option selected="" value="">Select Religion</option>
                <option value="islam">Islam</option>
                <option value="christianity">Christianity</option>
                <option value="hinduism">Hinduism</option>
                <option value="buddhism">Buddhism</option>
            </x-form.select-input-sm>

            <x-form.label>blood group</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.blood_group" error="form.blood_group" disabled>
                <option selected="" value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </x-form.select-input-sm>

            <x-form.label>gender</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.gender" error="form.gender" disabled>
                <option selected="" value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </x-form.select-input-sm>

            <x-form.label>present address</x-form.label>
            <x-form.text-input wire:model.blur="form.present_address" error="form.present_address" placeholder="Enter present address" readonly/>

            <x-form.label>permanent address</x-form.label>
            <x-form.text-input wire:model.blur="form.permanent_address" error="form.permanent_address" placeholder="Enter permanent address" readonly/>

            <x-form.label>education</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.education" error="form.education" disabled>
                <option selected="" value="">Select Education</option>
                <option value="JSC">JSC</option>
                <option value="SSC">SSC</option>
                <option value="HSC">HSC</option>
            </x-form.select-input-sm>
        </x-form.section>

        <x-form.section title="Employment Information">
            <x-form.label>osrm code</x-form.label>
            <x-form.text-input wire:model.blur="form.osrm_code" error="form.osrm_code" placeholder="Enter osrm code" readonly/>

            <x-form.label>employee code</x-form.label>
            <x-form.text-input wire:model.blur="form.employee_code" error="form.employee_code" placeholder="Enter employee code" readonly/>

            <x-form.label>rso code</x-form.label>
            <x-form.text-input wire:model.blur="form.rso_code" error="form.rso_code" placeholder="Enter rso code" readonly/>

            <x-form.label>itop number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.itop_number" error="form.itop_number" placeholder="Enter itop number" readonly/>

            <x-form.label>pool number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.pool_number" error="form.pool_number" placeholder="Enter pool number" readonly/>

            <x-form.label>market type</x-form.label>
            <x-form.text-input wire:model.blur="form.market_type" error="form.market_type" placeholder="Enter market type" readonly/>

            <x-form.label>category</x-form.label>
            <x-form.text-input wire:model.blur="form.category" error="form.category" placeholder="Enter category" readonly/>

            <x-form.label>agency name</x-form.label>
            <x-form.text-input wire:model.blur="form.agency_name" error="form.agency_name" placeholder="Enter agency name" readonly/>

            <x-form.label>sr no</x-form.label>
            <x-form.text-input wire:model.blur="form.sr_no" error="form.sr_no" placeholder="Enter sr no" readonly/>

            <x-form.label>joining date</x-form.label>
            <x-form.text-input type="date" wire:model.blur="form.joining_date" error="form.joining_date" readonly/>

            <x-form.label>Document</x-form.label>
            <div class="sm:col-span-9">
                <div class="space-y-2">
                    @if($document)
                        <button
                            class="flex items-center text-sm text-gray-600 dark:text-neutral-400 hover:text-green-500 hover:underline font-semibold"
                            type="button" wire:click="download({{ $form->rsoId }})">
                            Download Attachment
                            <x-icon.paperclip/>
                        </button>
                    @else
                        No attachment found.
                    @endif
                </div>
            </div>
        </x-form.section>

        <x-form.section title="Financial Information">
            <x-form.label>salary</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.salary" error="form.salary" placeholder="Enter salary" readonly/>

            <x-form.label>bank account name</x-form.label>
            <x-form.text-input wire:model.blur="form.bank_account_name" error="form.bank_account_name" placeholder="Enter bank account name" readonly/>

            <x-form.label>bank name</x-form.label>
            <x-form.text-input wire:model.blur="form.bank_name" error="form.bank_name" placeholder="Enter bank name" readonly/>

            <x-form.label>bank account number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.bank_account_number" error="form.bank_account_number" placeholder="Enter bank account number" readonly/>

            <x-form.label>brunch name</x-form.label>
            <x-form.text-input wire:model.blur="form.brunch_name" error="form.brunch_name" placeholder="Enter brunch name" readonly/>

            <x-form.label>routing number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.routing_number" error="form.routing_number" placeholder="Enter routing number" readonly/>
        </x-form.section>

        <x-form.section title="Location Information">
            <x-form.label>division</x-form.label>
            <x-form.text-input wire:model.blur="form.division" error="form.division" placeholder="Enter division" readonly/>

            <x-form.label>district</x-form.label>
            <x-form.text-input wire:model.blur="form.district" error="form.district" placeholder="Enter district" readonly/>

            <x-form.label>thana</x-form.label>
            <x-form.text-input wire:model.blur="form.thana" error="form.thana" placeholder="Enter thana" readonly/>
        </x-form.section>

        <x-form.section>
            <x-form.label>Status</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.status" error="form.status" disabled>
                <option selected="" value="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </x-form.select-input-sm>
        </x-form.section>
    </x-form>
</div>
