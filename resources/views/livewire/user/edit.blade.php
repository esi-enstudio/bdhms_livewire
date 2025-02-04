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
        <x-profile-management.select-input-for-user-role wire:model.blur="role" label="Select Role" :roles="$roles">
            @forelse($roles as $role)
                <option value="{{ $role->name }}">{{ Str::title($role->name) }}</option>
            @empty
                <option>No roles found</option>
            @endforelse
        </x-profile-management.select-input-for-user-role>

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
