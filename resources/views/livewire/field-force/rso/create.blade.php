<div>

    <x-form
            heading="Create New Rso"
            subheading="Fill in the details below to register a new RS0."
            :cancelBtnUrl="route('rso.index')"
            cancelBtnText="Cancel"
            :action=" (object) [
                'btnType' => 'button',
//                'url' => route('houses.edit', 5), // required if button type is 'link'
                'btnText' => 'Create Rso',
            ]"
            submitMethod="store"
    >

        <x-form.section title="Assign House and User">
            <x-form.label>House</x-form.label>
            <x-form.select-input-sm wire:model.live="form.house_id" error="form.house_id">
                <option selected="" value="">Select House</option>
                @forelse($houses as $house)
                    <option value="{{ $house->id }}">{{ $house->code.'-'.$house->name }}</option>
                @empty
                    <option>No data found</option>
                @endforelse
            </x-form.select-input-sm>

            <x-form.label>User</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.user_id" error="form.user_id">
                <option selected="" value="">Select User</option>
                @forelse($users as $user)
                    <option value="{{ $user->id }}">{{ $user->phone.'-'.$user->name }}</option>
                @empty
                    <option>No data found</option>
                @endforelse
            </x-form.select-input-sm>
        </x-form.section>

        <x-form.section title="Personal Information">
            <x-form.label>Personal Number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.personal_number" error="form.personal_number" placeholder="Enter personal number"/>

            <x-form.label>father name</x-form.label>
            <x-form.text-input wire:model.blur="form.father_name" error="form.father_name" placeholder="Enter father name"/>

            <x-form.label>mother name</x-form.label>
            <x-form.text-input wire:model.blur="form.mother_name" error="form.mother_name" placeholder="Enter mother name"/>

            <x-form.label>date of birth</x-form.label>
            <x-form.text-input type="date" wire:model.blur="form.dob" error="form.dob"/>

            <x-form.label>nid</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.nid" error="form.nid" placeholder="Enter nid number"/>

            <x-form.label>religion</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.religion" error="form.religion">
                <option selected="" value="">Select Religion</option>
                <option value="islam">Islam</option>
                <option value="christianity">Christianity</option>
                <option value="hinduism">Hinduism</option>
                <option value="buddhism">Buddhism</option>
            </x-form.select-input-sm>

            <x-form.label>blood group</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.blood_group" error="form.blood_group">
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
            <x-form.select-input-sm wire:model.blur="form.gender" error="form.gender">
                <option selected="" value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </x-form.select-input-sm>

            <x-form.label>present address</x-form.label>
            <x-form.text-input wire:model.blur="form.present_address" error="form.present_address" placeholder="Enter present address"/>

            <x-form.label>permanent address</x-form.label>
            <x-form.text-input wire:model.blur="form.permanent_address" error="form.permanent_address" placeholder="Enter permanent address"/>

            <x-form.label>education</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.education" error="form.education">
                <option selected="" value="">Select Education</option>
                <option value="JSC">JSC</option>
                <option value="SSC">SSC</option>
                <option value="HSC">HSC</option>
            </x-form.select-input-sm>
        </x-form.section>

        <x-form.section title="Employment Information">
            <x-form.label>osrm code</x-form.label>
            <x-form.text-input wire:model.blur="form.osrm_code" error="form.osrm_code" placeholder="Enter osrm code"/>

            <x-form.label>employee code</x-form.label>
            <x-form.text-input wire:model.blur="form.employee_code" error="form.employee_code" placeholder="Enter employee code"/>

            <x-form.label>rso code</x-form.label>
            <x-form.text-input wire:model.blur="form.rso_code" error="form.rso_code" placeholder="Enter rso code"/>

            <x-form.label>itop number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.itop_number" error="form.itop_number" placeholder="Enter itop number"/>

            <x-form.label>pool number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.pool_number" error="form.pool_number" placeholder="Enter pool number"/>

            <x-form.label>market type</x-form.label>
            <x-form.text-input wire:model.blur="form.market_type" error="form.market_type" placeholder="Enter market type"/>

            <x-form.label>category</x-form.label>
            <x-form.text-input wire:model.blur="form.category" error="form.category" placeholder="Enter category"/>

            <x-form.label>agency name</x-form.label>
            <x-form.text-input wire:model.blur="form.agency_name" error="form.agency_name" placeholder="Enter agency name"/>

            <x-form.label>sr no</x-form.label>
            <x-form.text-input wire:model.blur="form.sr_no" error="form.sr_no" placeholder="Enter sr no"/>

            <x-form.label>joining date</x-form.label>
            <x-form.text-input type="date" wire:model.blur="form.joining_date" error="form.joining_date"/>

            <x-form.label>Documents Upload</x-form.label>
            <x-form.file-upload wire:model.blur="form.documents" error="form.documents"/>
        </x-form.section>

        <x-form.section title="Financial Information">
            <x-form.label>salary</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.salary" error="form.salary" placeholder="Enter salary"/>

            <x-form.label>bank account name</x-form.label>
            <x-form.text-input wire:model.blur="form.bank_account_name" error="form.bank_account_name" placeholder="Enter bank account name"/>

            <x-form.label>bank name</x-form.label>
            <x-form.text-input wire:model.blur="form.bank_name" error="form.bank_name" placeholder="Enter bank name"/>

            <x-form.label>bank account number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.bank_account_number" error="form.bank_account_number" placeholder="Enter bank account number"/>

            <x-form.label>brunch name</x-form.label>
            <x-form.text-input wire:model.blur="form.brunch_name" error="form.brunch_name" placeholder="Enter brunch name"/>

            <x-form.label>routing number</x-form.label>
            <x-form.text-input type="number" wire:model.blur="form.routing_number" error="form.routing_number" placeholder="Enter routing number"/>
        </x-form.section>

        <x-form.section title="Location Information">
            <x-form.label>division</x-form.label>
            <x-form.text-input wire:model.blur="form.division" error="form.division" placeholder="Enter division"/>

            <x-form.label>district</x-form.label>
            <x-form.text-input wire:model.blur="form.district" error="form.district" placeholder="Enter district"/>

            <x-form.label>thana</x-form.label>
            <x-form.text-input wire:model.blur="form.thana" error="form.thana" placeholder="Enter thana"/>
        </x-form.section>

        <x-form.section title="Status">
            <x-form.label>Status</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.status" error="form.status">
                <option value="" selected="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </x-form.select-input-sm>
        </x-form.section>

        <!-- Summary -->
        <div class="py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent space-y-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                Description
            </h2>

            <p class="mt-3 text-sm font-medium text-gray-600 dark:text-neutral-400">
                Use this form to add a new Retail Sales Officer (RSO) to the system. Ensure all required fields are accurately filled, including:
            </p>

            <ul class="list-disc list-inside text-sm space-y-2">
                <li>
                    <strong>Personal Information:</strong>
                    <span>Name, contact details, addresses, date of birth, and NID.</span>
                </li>
                <li>
                    <strong>Professional Details:</strong>
                    <span>House and user IDs, OSRM and RSO codes, employee and ITOP numbers, market type, and category.</span>
                </li>
                <li>
                    <strong>Banking Information:</strong>
                    <span>Bank account details, routing number, and branch name.</span>
                </li>
                <li>
                    <strong>Additional Information:</strong>
                    <span>Education, blood group, gender, salary, agency, and relevant remarks or documents.</span>
                </li>
            </ul>

            <p class="mt-3 text-sm font-medium text-gray-600 dark:text-neutral-400">
                Carefully review the provided details before submitting to maintain data accuracy.
            </p>

        </div>
        <!-- End Summary -->

    </x-form>

</div>
