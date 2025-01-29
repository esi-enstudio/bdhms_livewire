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

    <!-- Filter -->
    <x-filter>
        <!-- Status -->
        <x-select-input-sm wire:model.live="status" label="Status" class="!rounded-full">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </x-select-input-sm>
        <!-- Status end -->

        <!-- Action -->
        <x-filter.action-btn>
            <x-filter.button
                    label="Delete"
                    :data="$selectedRecords"
                    wire:click="deleteSelected"
                    wire:confirm="Are you sure to delete selected records?"
            />

            <x-filter.button
                    label="Active"
                    :data="$selectedRecords"
                    wire:click="activateSelected"
                    wire:confirm="Are you sure to active selected records?"
            />

            <x-filter.button
                    label="Inactive"
                    :data="$selectedRecords"
                    wire:click="deactivateSelected"
                    wire:confirm="Are you sure to inactive selected records?"
            />
        </x-filter.action-btn>
        <!-- Action end -->
    </x-filter>
    <!-- Filter end -->

    <!-- Table Section -->
    <x-table
            title="Houses"
            subtitle="List of all houses"
            primary-btn-text="Add New"
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
                        <x-nav-link wire:navigate :href="route('houses.show', $house->id)">Detail's</x-nav-link>
                    </x-table.td>
                </tr>
            @empty
                <x-table.td class="text-center" colspan="7">No house found.</x-table.td>
            @endforelse
        </x-slot:tbody>
    </x-table>
    <!-- End Table Section -->
</div>
