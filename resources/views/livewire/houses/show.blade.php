<div>
    <x-form
            heading="Distribution House Details"
            subheading="Review and update the specific details of the distribution house as needed."
            :cancelBtnUrl="route('houses.index')"
            cancelBtnText="Cancel"
            :action=" (object) [
                'btnType' => 'link',
                'url' => route('houses.edit', $form->house->id), // required if button type is 'link'
                'btnText' => 'Edit',
            ]"
            :deleteId="$form->house->id"
{{--            submitMethod="update"  --}}{{-- default form submit method is 'store' --}}
    >
        <x-form.section title="Identification and Location">

            <x-form.label>Code</x-form.label>
            <x-form.text-input wire:model.blur="form.code" error="form.code" placeholder="Enter house code" readonly/>

            <x-form.label>Name</x-form.label>
            <x-form.text-input wire:model.blur="form.name" error="form.name" placeholder="Enter house name" readonly/>

            <x-form.label>Cluster</x-form.label>
            <x-form.text-input wire:model.blur="form.cluster" error="form.cluster" placeholder="Enter cluster name" readonly/>

            <x-form.label>Region</x-form.label>
            <x-form.text-input wire:model.blur="form.region" error="form.region" placeholder="Enter region name" readonly/>

            <x-form.label>District</x-form.label>
            <x-form.text-input wire:model.blur="form.district" error="form.district" placeholder="Enter house district name" readonly/>

            <x-form.label>Thana</x-form.label>
            <x-form.text-input wire:model.blur="form.thana" error="form.thana" placeholder="Enter house thana name" readonly/>

        </x-form.section>

        <x-form.section title="Contact Information">

            <x-form.label>Email</x-form.label>
            <x-form.text-input wire:model.blur="form.email" error="form.email" type="email" placeholder="Enter email" readonly/>

            <x-form.label>Address</x-form.label>
            <x-form.text-input wire:model.blur="form.address" error="form.address" placeholder="Enter address" readonly/>

        </x-form.section>

        <x-form.section title="Personnel Information">

            <x-form.label>Proprietor Name</x-form.label>
            <x-form.text-input wire:model.blur="form.proprietor_name" error="form.proprietor_name" placeholder="Enter proprietor name" readonly/>

            <x-form.label>Proprietor Number</x-form.label>
            <x-form.text-input wire:model.blur="form.contact_number" error="form.contact_number" type="number" placeholder="Enter proprietor number" readonly/>

            <x-form.label>POC Name</x-form.label>
            <x-form.text-input wire:model.blur="form.poc_name" error="form.poc_name" placeholder="Enter poc name" readonly/>

            <x-form.label>POC Number</x-form.label>
            <x-form.text-input wire:model.blur="form.poc_number" error="form.poc_number" type="number" placeholder="Enter poc number" readonly/>

        </x-form.section>

        <x-form.section title="Operational Details">

            <x-form.label>Lifting Date</x-form.label>
            <x-form.text-input wire:model.blur="form.lifting_date" error="form.lifting_date" type="date" readonly/>

            <x-form.label>Status</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.status" error="form.status" disabled>
                <option selected="" value="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </x-form.select-input-sm>

            <x-form.label>Remarks</x-form.label>
            <x-form.text-input wire:model.blur="form.remarks" error="form.remarks" placeholder="Enter remarks" readonly/>
        </x-form.section>

        <!-- Summary -->
        <div class="py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent space-y-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                Summary
            </h2>

            <p class="mt-3 text-sm font-medium text-gray-600 dark:text-neutral-400">
                This page provides a detailed overview of the selected distribution house. Above, you will find comprehensive information organized into key sections:
            </p>

            <ul class="list-disc list-inside text-sm space-y-2">
                <li>
                    <strong>Identification & Location:</strong>
                    <span>Includes the house code, name, cluster, region, district, and thana.</span>
                </li>
                <li>
                    <strong>Contact Information:</strong>
                    <span>Lists the email, address, and primary contact number for communication.</span>
                </li>
                <li>
                    <strong>Personnel Information:</strong>
                    <span>Displays the proprietor's name and the point of contact details, including their name and phone number.</span>
                </li>
                <li>
                    <strong>Operational Details:</strong>
                    <span>Highlights the latest lifting date, current status, and any remarks associated with the distribution house.</span>
                </li>
            </ul>

            <p class="mt-3 text-sm font-medium text-gray-600 dark:text-neutral-400">
                Use this page to view all essential details at a glance.
            </p>

        </div>
        <!-- End Summary -->

    </x-form>
</div>
