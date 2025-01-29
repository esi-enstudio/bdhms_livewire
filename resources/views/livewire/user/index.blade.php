<div class="space-y-4">
    <!-- Page title -->
    <x-title title="Users" subtitle="List all users"/>
    <!-- Page title end -->

    <!-- Search box -->
    <x-searchbox wire:model.live.debounce.500ms="search" placeholder="Search in user"/>
    <!-- Search box end -->

    <!-- Session message -->
    <x-session/>
    <!-- Session message end -->

    <!-- Filter -->
    <x-filter>
        <!-- Role -->
        <x-select-input-sm wire:model.live="role" label="Roles" class="!rounded-full">
            @foreach($form->roles as $role)
                <option value="{{ $role['value'] }}">{{ \Illuminate\Support\Str::title($role['label']) }}</option>
            @endforeach
        </x-select-input-sm>
        <!-- Role end -->

        <!-- Status -->
        <x-select-input-sm wire:model.live="status" label="Status" class="!rounded-full">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </x-select-input-sm>
        <!-- Status end -->

        <!-- Action button -->
        <x-filter.action-btn>
            <x-filter.button
                label="Delete"
                :data="$selectedUsers"
                wire:click="deleteSelected"
                wire:confirm="Are you sure to delete selected users?"
            />

            <x-filter.button
                label="Active"
                :data="$selectedUsers"
                wire:click="activateSelected"
                wire:confirm="Are you sure to active selected users?"
            />

            <x-filter.button
                label="Inactive"
                :data="$selectedUsers"
                wire:click="deactivateSelected"
                wire:confirm="Are you sure to inactive selected users?"
            />
        </x-filter.action-btn>
        <!-- Action button end -->
    </x-filter>
    <!-- Filter end -->

    <!-- Checkbox select all users -->
    <div class="flex items-center justify-between bg-">
        <x-checkbox-input wire:model.live="selectAll" label="Select All"/>

        @if($selectedUsers)
            <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Total {{ count($selectedUsers) }} users selected</span>
        @endif
    </div>
    <!-- Checkbox select all users end -->

    <!-- Loop records -->
    <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 gap-4">
        @forelse($users as $key => $user)
            <x-card.primary
                wire:key="{{ $key }}"
                :title="$user->name"
                :subtitle="$user->phone"
                :image="$user->avatar"
                :show-url="route('user.show', $user->id)"
                :delete-id="$user->id"
                class="relative"
                :isCheckbox="true"
            >
                @switch($user->status)
                    @case('active')
                        <span class="font-semibold text-green-500">Active</span>
                        @break

                    @case('inactive')
                        <span class="font-semibold text-red-500">Inactive</span>
                        @break
                @endswitch
            </x-card.primary>
        @empty
            No data to found
        @endforelse
    </div>
    <!-- Loop records end -->

    <!-- Pagination -->
    {{ $users->links('vendor.livewire.simple-tailwind') }}
    <!-- Pagination end -->
</div>


