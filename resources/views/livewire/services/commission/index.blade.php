<div class="space-y-4">
    <!-- Page title -->
    <x-title title="Commission" subtitle="List all commissions"/>
    <!-- Page title end -->

    <!-- Search box -->
    <x-searchbox wire:model.live.debounce.500ms="search" placeholder="Search in commission..."/>
    <!-- Search box end -->

    <!-- Session message -->
    <x-session/>
    <!-- Session message end -->

    <!-- Table Section -->
    <x-table
            primary-btn-text="Add New"
            create-permission="create commission"
            :primary-btn-link="route('commission.create')"
            :pagination="$this->commissions"
    >
        <x-slot:thead>
            <tr>
                <x-table.th wire:model.live="selectAll" :checkbox="true"/>
                <x-table.th>House</x-table.th>
                <x-table.th>For/Type</x-table.th>
                <x-table.th>Name/Month</x-table.th>
                <x-table.th>Net Amount</x-table.th>
                <x-table.th>Receive Date</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th></x-table.th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            @forelse($this->commissions as $key => $commission)
                <tr wire:key="{{ $key }}">
                    <x-table.td
                            wire:model.live="selectedRecords"
                            :checkbox="true"
                            :value="$commission->id"
                    />
                    <x-table.td
                            :title="$commission->house->code ?? 'N/A'"
                            :subtitle="$commission->house->name ?? 'N/A'"
                    />
                    <x-table.td
                            :title="$commission->for ?? 'N/A'"
                            :subtitle="$commission->type ?? 'N/A'"
                    />
                    <x-table.td
                            :title="$commission->name ?? 'N/A'"
                            :subtitle="($commission->month ? \Carbon\Carbon::parse($commission->month)->format('F, Y') : '') ?? 'N/A'"
                    />
                    <x-table.td :title="$commission->amount ?? 'N/A'"/>
                    <x-table.td :title="($commission->receive_date ? \Carbon\Carbon::parse($commission->receive_date)->toFormattedDateString() : '') ?? 'N/A'"/>
                    <x-table.td :title="$commission->status ?? 'N/A'"/>
                    <x-table.td>
                        <x-table.action-btn
                                show-permission="show commission"
                                edit-permission="edit commission"
                                delete-permission="delete commission"
                                :edit="route('commission.edit', $commission->id)"
                                :show="route('commission.show', $commission->id)"
                                :delete="$commission->id"
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
    @can('delete all replace')
        @if($allCommissionCount > 0)
            <div class="flex items-center justify-between max-w-[85rem] mx-auto px-4">
                <x-text-button wire:click="deleteAll" wire:confirm="Are you sure to delete all records?" color="red">Delete ALL ({{ $allCommissionCount }})</x-text-button>
            </div>
        @endif
    @endcan
    <!-- End Delete All Records -->
</div>
