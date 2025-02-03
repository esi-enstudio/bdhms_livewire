<div class="space-y-4">
    <!-- Page title -->
    <x-title title="Permissions" subtitle="List all Permissions"/>
    <!-- Page title end -->

    <!-- Search box -->
    <x-searchbox wire:model.live.debounce.500ms="search" placeholder="Search in permission..."/>
    <!-- Search box end -->

    <!-- Session message -->
    <x-session/>
    <!-- Session message end -->

    <!-- Table Section -->
    <x-table
            primary-btn-text="Add New"
            :primary-btn-link="route('permission.create')"
            :pagination="$this->permissions"
    >
        <x-slot:thead>
            <tr>
                <x-table.th wire:model.live="selectAll" :checkbox="true"/>
                <x-table.th>Name</x-table.th>
                <x-table.th>group name</x-table.th>
                <x-table.th>Created at</x-table.th>
                <x-table.th>updated at</x-table.th>
                <x-table.th></x-table.th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            @forelse($this->permissions as $key => $permission)
                <tr wire:key="{{ $key }}">
                    <x-table.td
                            wire:model.live="selectedRecords"
                            :checkbox="true"
                            :value="$permission->id"
                    />
                    <x-table.td :title="$permission->name ?? 'N/A'"/>
                    <x-table.td :title="$permission->group_name ?? 'N/A'"/>
                    <x-table.td
                            :title="\Carbon\Carbon::parse($permission->created_at)->diffForHumans()"
                            :subtitle="\Carbon\Carbon::parse($permission->created_at)->toDayDateTimeString()"
                    />
                    <x-table.td
                            :title="\Carbon\Carbon::parse($permission->updated_at)->diffForHumans()"
                            :subtitle="\Carbon\Carbon::parse($permission->updated_at)->toDayDateTimeString()"
                    />
                    <x-table.td>
                        <x-table.action-btn
                                :edit="route('permission.edit', $permission->id)"
                                :delete="$permission->id"
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
    @if($allPermissionCount > 0 && Auth::user()->role == 'admin')
        <div class="flex items-center justify-between max-w-[85rem] mx-auto px-4">
            <x-text-button wire:click="deleteAll" wire:confirm="Are you sure to delete all records?" color="red">Delete ALL ({{ $allPermissionCount }})</x-text-button>
        </div>
    @endif
    <!-- End Delete All Records -->
</div>
