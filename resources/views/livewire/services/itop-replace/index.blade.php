<div class="space-y-4">
    <!-- Session message -->
    <x-session/>
    <!-- Session message end -->

    <!-- Page title -->
    <x-title title="Itop Replace" subtitle="List all replacement"/>
    <!-- Page title end -->

    <!-- Search box -->
    <x-searchbox wire:model.live.debounce.500ms="search" placeholder="Search in replace list..."/>
    <!-- Search box end -->

    <!-- Table Section -->
    <x-table
        title="Itop Replace"
        subtitle="List of all replacement"
        primary-btn-text="Add New"
        :primary-btn-link="route('itopReplace.create')"
        :pagination="$this->replaces"
    >
        <x-slot:thead>
            <tr>
                <x-table.th wire:model.live="selectAll" :checkbox="true"/>
                <x-table.th>Request By</x-table.th>
                <x-table.th>Retailer</x-table.th>
                <x-table.th>Serial Number</x-table.th>
                <x-table.th>Had Balance</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Request At</x-table.th>
                <x-table.th></x-table.th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            @forelse($this->replaces as $key => $replace)
                <tr wire:key="{{ $key }}">
                    <x-table.td
                        wire:model.live="selectedRecords"
                        :checkbox="true"
                        :value="$replace->id"
                    />

                    <x-table.td
                        :title="$replace->user->name ?? 'N/A'"
                        :subtitle="$replace->user->phone ?? 'N/A'"
                        :avatar="optional($replace->user)->avatar"
                        :showAvatar="true"
                        :link="true"
                        :link_url="route('user.show', $replace->user->id ?? 0)"
                    />

                    <x-table.td
                        :link="true"
                        :link_url="route('retailer.show', $replace->retailer_id)"
                        :title="$replace->retailer->itop_number ?? 'N/A'"
                        :subtitle="$replace->retailer->code ?? 'N/A'"
                    />

                    <x-table.td
                        :subtitle="$replace->sim_serial ?? 'N/A'"
                    />

                    <x-table.td
                        :subtitle="$replace->balance ?? 'N/A'"
                    />

                    <x-table.td
                        :status="$replace->status"
                        :status_type="$replace->status == 'pending' || 'processing' ? 'warning' : 'success'"
                    />

                    <x-table.td>
                        {{ \Carbon\Carbon::parse($replace->requested_at)->diffForHumans() }}
                    </x-table.td>

                    <x-table.td>
                        <x-table.action-btn
                            :edit="route('itopReplace.edit', $replace->id)"
                            :show="route('retailer.show', $replace->id)"
                            :delete="$replace->id"
                        />
                    </x-table.td>
                </tr>
            @empty
                <x-table.td class="text-center" colspan="7">No data found.</x-table.td>
            @endforelse
        </x-slot:tbody>
    </x-table>
    <!-- End Table Section -->
</div>
