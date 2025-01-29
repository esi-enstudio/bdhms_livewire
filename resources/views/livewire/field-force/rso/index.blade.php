<div class="space-y-4">

    <!-- Page title -->
    <x-title title="Rsos" subtitle="List all rso"/>
    <!-- Page title end -->

    <!-- Search box -->
    <x-searchbox wire:model.live.debounce.500ms="search" placeholder="Search in rso"/>
    <!-- Search box end -->

    <!-- Session message -->
    <x-session/>
    <!-- Session message end -->

    <!-- Filter -->
    <x-filter>
        <!-- House -->
        <x-select-input-sm wire:model.live="houseId" label="All House" class="!rounded-full">
            @foreach($this->houses as $house)
                <option value="{{ $house->id }}">{{ $house->name }}</option>
            @endforeach
        </x-select-input-sm>
        <!-- House end -->

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
        title="Rso"
        subtitle="List of all rso"
        primary-btn-text="Add New"
        :primary-btn-link="route('rso.create')"
        :pagination="$this->rsos"
    >
        <x-slot:thead>
            <tr>
                <x-table.th wire:model.live="selectAll" :checkbox="true"/>
                <x-table.th>Name</x-table.th>
                <x-table.th>House</x-table.th>
                <x-table.th>Itop Number</x-table.th>
                <x-table.th>Address</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th></x-table.th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            @forelse($this->rsos as $key => $rso)
                <tr wire:key="{{ $key }}">
                    <x-table.td
                            wire:model.live="selectedRecords"
                            :checkbox="true"
                            :value="$rso->id"
                    />
                    <x-table.td
                            :title="$rso->user->name ?? 'N/A'"
                            :subtitle="$rso->user->phone ?? 'N/A'"
                            :avatar="optional($rso->user)->avatar"
                            :showAvatar="true"
                            :link="true"
                            :link_url="route('user.show', $rso->user->id)"
                    />
                    <x-table.td
                            :title="$rso->house->name ?? 'N/A'"
                            :subtitle="$rso->house->code ?? 'N/A'"
                    />
                    <x-table.td
                            :title="$rso->itop_number ?? 'N/A'"
                            :subtitle="$rso->rso_code ?? 'N/A'"
                    />
                    <x-table.td
                            :title="$rso->present_address ?? 'N/A'"
                    />
                    <x-table.td
                            :status="$rso->status"
                            :status_type="$rso->status == 'active' ? 'success' : 'danger'"
                    />
                    <x-table.td>
                        <x-table.action-btn
                                :edit="route('rso.edit', $rso->id)"
                                :show="route('rso.show', $rso->id)"
                                :delete="$rso->id"
                                :additional="$rso"
                        />
                    </x-table.td>
                </tr>
            @empty
                <x-table.td class="text-center" colspan="7">No rso found.</x-table.td>
            @endforelse
        </x-slot:tbody>
    </x-table>
    <!-- End Table Section -->
</div>
