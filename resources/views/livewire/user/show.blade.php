<div>
    <x-profile-management :show="$isShow" :id="$editId">
        <x-slot:title>{{ $username }}</x-slot:title>
        <x-slot:subtitle>Manage your name, password and account settings.</x-slot:subtitle>

        <x-profile-management.label caption="">Profile photo</x-profile-management.label>
        <x-profile-management.profile-picture wire:model.blur="form.avatar" :preview="$avatarPreview" :file-name="$fileName" :is-file-upload="false"/>

        <x-profile-management.label caption="">Full Name</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.name" placeholder="Enter full name" disabled/>

        <x-profile-management.label caption="">Phone Number</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.phone" type="number" placeholder="Enter phone number" disabled/>

        <x-profile-management.label caption="">Email</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.email" type="email" placeholder="Enter email address" disabled/>

        <x-profile-management.label caption="">Role</x-profile-management.label>
        <div class="sm:col-span-9">
            @foreach($roles as $role)
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">
                {{ Str::title($role) }}
            </span>
            @endforeach
        </div>

        <x-profile-management.label caption="">Remarks</x-profile-management.label>
        <x-profile-management.text-input wire:model.blur="form.remarks" placeholder="Enter remarks" disabled/>

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
