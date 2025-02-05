<div class="space-y-4">

    <!-- Page title -->
    <x-title title="Houses" subtitle="List all houses"/>
    <!-- Page title end -->

    <!-- Search box -->
    <x-searchbox wire:model.live.debounce.500ms="search" placeholder="Search in house"/>
    <!-- Search box end -->

    <!-- Session message -->
    <x-session/>
    <!-- Session message end -->

    <!-- Table Section -->
    <x-table
            title="Houses"
            subtitle="List of all houses"
            primary-btn-text="Add New"
            create_permission="create house"
            :primary-btn-link="route('houses.create')"
            :pagination="$houses"
    >
        <x-slot:thead>
            <tr>
                <x-table.th wire:model.live="selectAll" :checkbox="true"/>
                <x-table.th>House Name</x-table.th>
                <x-table.th>Region</x-table.th>
                <x-table.th>Email</x-table.th>
                <x-table.th>Address</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th></x-table.th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            @forelse($houses as $key => $house)
                <tr wire:key="{{ $key }}">
                    <x-table.td wire:model.live="selectedRecords" :checkbox="true" :value="$house->id"/>
                    <x-table.td :title="$house->name" :subtitle="$house->code" :showAvatar="true"/>
                    <x-table.td :title="$house->region" :subtitle="$house->cluster"/>
                    <x-table.td :title="$house->email"/>
                    <x-table.td :title="$house->address"/>
                    <x-table.td :status="$house->status" :status_type="$house->status == 'active' ? 'success' : 'danger'"/>
                    <x-table.td>
                        @can('show house')
                            <x-nav-link
                                    wire:navigate
                                    :href="route('houses.show', $house->id)"
                            >
                                Detail's
                            </x-nav-link>
                        @endcan
                    </x-table.td>
                </tr>
            @empty
                <x-table.td class="text-center" colspan="7">No house found.</x-table.td>
            @endforelse
        </x-slot:tbody>
    </x-table>
    <!-- End Table Section -->
</div>
