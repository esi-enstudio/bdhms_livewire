<div>
    <x-profile-management :show="$isShow" :id="$editId">
        <x-slot:title>{{ $username }}</x-slot:title>
        <x-slot:subtitle>Manage your name, password and account settings.</x-slot:subtitle>

        <x-profile-management.label caption="">Profile photo</x-profile-management.label>
        <x-profile-management.profile-picture wire:model.blur="form.avatar" :preview="$avatarPreview" :file-name="$fileName" :is-file-upload="false"/>

        <x-profile-management.label caption="">Full Name</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.name" placeholder="Enter full name" readonly/>

        <x-profile-management.label caption="">Phone Number</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.phone" type="number" placeholder="Enter phone number" readonly/>

        <x-profile-management.label caption="">Email</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.email" type="email" placeholder="Enter email address" readonly/>

        <x-profile-management.label caption="">Role</x-profile-management.label>
        <x-profile-management.select-input-sm wire:model.blur="form.role" label="Role" :options="$form->roles" disabled/>

        <x-profile-management.label caption="">Remarks</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.remarks" placeholder="Enter remarks" readonly/>

        <x-profile-management.label caption="">Status</x-profile-management.label>
        <x-profile-management.select-input-sm wire:model.blur="form.status" label="Status" :options="$form->selectStatus" disabled/>

        <x-profile-management.label caption="">Assign House</x-profile-management.label>
        <x-profile-management.checkbox-input wire:model.blur="form.houses" :items="$houses" disabled/>

        <x-profile-management.label caption="">Created</x-profile-management.label>
        <x-profile-management.plain-text>{{ $createTimesAgo .' | '.$created }}</x-profile-management.plain-text>

        <x-profile-management.label caption="">Updated</x-profile-management.label>
        <x-profile-management.plain-text>{{ $updateTimesAgo .' | '.$updated }}</x-profile-management.plain-text>
    </x-profile-management>
</div>
