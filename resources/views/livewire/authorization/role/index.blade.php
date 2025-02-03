<div class="space-y-4">
    <!-- Page title -->
    <x-title title="Roles" subtitle="List all Roles"/>
    <!-- Page title end -->

    <!-- Search box -->
    <x-searchbox wire:model.live.debounce.500ms="search" placeholder="Search in roles..."/>
    <!-- Search box end -->

    <!-- Session message -->
    <x-session/>
    <!-- Session message end -->

    <!-- Table Section -->
    <x-table
            primary-btn-text="Add New"
            :primary-btn-link="route('role.create')"
            :pagination="$this->roles"
    >
        <x-slot:thead>
            <tr>
                <x-table.th wire:model.live="selectAll" :checkbox="true"/>
                <x-table.th>Name</x-table.th>
                <x-table.th>Permissions</x-table.th>
                <x-table.th>Created at</x-table.th>
                <x-table.th>updated at</x-table.th>
                <x-table.th></x-table.th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            @forelse($this->roles as $key => $role)
                <tr wire:key="{{ $key }}">
                    <x-table.td
                            wire:model.live="selectedRecords"
                            :checkbox="true"
                            :value="$role->id"
                    />
                    <x-table.td :title="Str::title($role->name) ?? 'N/A'"/>
                    <x-table.td>
                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">{{ Str::title($role->permissions->pluck('name')->implode(', ')) }}</span>
                    </x-table.td>
                    <x-table.td
                            :title="\Carbon\Carbon::parse($role->created_at)->diffForHumans()"
                            :subtitle="\Carbon\Carbon::parse($role->created_at)->toDayDateTimeString()"
                    />
                    <x-table.td
                            :title="\Carbon\Carbon::parse($role->updated_at)->diffForHumans()"
                            :subtitle="\Carbon\Carbon::parse($role->updated_at)->toDayDateTimeString()"
                    />
                    <x-table.td>
                        <x-table.action-btn
                                :edit="route('role.edit', $role->id)"
                                :delete="$role->id"
                        />
                    </x-table.td>
                </tr>
            @empty
                <x-table.td class="text-center" colspan="7">No data found.</x-table.td>
            @endforelse
        </x-slot:tbody>
    </x-table>
    <!-- End Table Section -->

    <!-- Delete All Records -->
    @if($allRoleCount > 0 && Auth::user()->role == 'admin')
        <div class="flex items-center justify-between max-w-[85rem] mx-auto px-4">
            <x-text-button wire:click="deleteAll" wire:confirm="Are you sure to delete all records?" color="red">Delete ALL ({{ $allRoleCount }})</x-text-button>
        </div>
    @endif
    <!-- End Delete All Records -->
</div>