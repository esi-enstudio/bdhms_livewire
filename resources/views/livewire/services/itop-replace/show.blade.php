<div>
    <!-- Page title -->
    <x-title :title="$replace->retailer->itop_number" :subtitle="$replace->sim_serial"/>
    <!-- Page title end -->

    <!-- Search box -->
    <x-searchbox wire:model.live.debounce.500ms="search" placeholder="Search with serial number..."/>
    <!-- Search box end -->

    <!-- Session message -->
    <x-session/>
    <!-- Session message end -->

    <!-- Current Status Table -->
    <x-table
            title="Last Replace"
            secondary-btn-text="Back"
            :secondary-btn-link="route('itopReplace.index')"
    >
        <x-slot:thead>
            <tr>
                <x-table.th/>
                <x-table.th>Request By</x-table.th>
                <x-table.th>Retailer</x-table.th>
                <x-table.th>Serial Number</x-table.th>
                <x-table.th>Had Balance</x-table.th>
                <x-table.th>Reason</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Remarks</x-table.th>
                <x-table.th>Description</x-table.th>
                <x-table.th>Request</x-table.th>
                <x-table.th>Completed</x-table.th>
                <x-table.th>Updated</x-table.th>
                <x-table.th>Created</x-table.th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            <tr>
                <x-table.td/>
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
                <x-table.td :subtitle="$replace->sim_serial ?? 'N/A'"/>
                <x-table.td :subtitle="$replace->balance ?? 'N/A'"/>
                <x-table.td :subtitle="$replace->reason ?? 'N/A'"/>
                <x-table.td
                        :status="$replace->status"
                        :status_type="$replace->status == 'pending' || 'processing' ? 'warning' : 'success'"
                />
                <x-table.td :subtitle="$replace->remarks ?? 'N/A'"/>
                <x-table.td :subtitle="$replace->description ?? 'N/A'"/>
                <x-table.td>
                    {{ $replace->requested_at ? \Carbon\Carbon::parse($replace->requested_at)->diffForHumans() : '' }}
                </x-table.td>
                <x-table.td>
                    {{ $replace->completed_at ? \Carbon\Carbon::parse($replace->completed_at)->diffForHumans() : '' }}
                </x-table.td>
                <x-table.td>
                    {{ $replace->updated_at ? \Carbon\Carbon::parse($replace->updated_at)->diffForHumans() : '' }}
                </x-table.td>
                <x-table.td>
                    {{ $replace->created_at ? \Carbon\Carbon::parse($replace->created_at)->diffForHumans() : '' }}
                </x-table.td>
            </tr>
        </x-slot:tbody>
    </x-table>
    <!-- Current Status End Table -->

    <!-- Replace History Table -->
    <x-table
            title="ALL Replace"
            :pagination="$histories"
    >
        <x-slot:thead>
            <tr>
                <x-table.th/>
                <x-table.th>Request By</x-table.th>
                <x-table.th>Retailer</x-table.th>
                <x-table.th>Serial Number</x-table.th>
                <x-table.th>Had Balance</x-table.th>
                <x-table.th>Reason</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Remarks</x-table.th>
                <x-table.th>Description</x-table.th>
                <x-table.th>Request</x-table.th>
                <x-table.th>Completed</x-table.th>
                <x-table.th>Updated</x-table.th>
                <x-table.th>Created</x-table.th>
            </tr>
        </x-slot:thead>

        <x-slot:tbody>
            @forelse($histories as $key => $replace)
                <tr wire:key="{{ $key }}">
                    <x-table.td/>
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
                    <x-table.td :subtitle="$replace->sim_serial ?? 'N/A'"/>
                    <x-table.td :subtitle="$replace->balance ?? 'N/A'"/>
                    <x-table.td :subtitle="$replace->reason ?? 'N/A'"/>
                    <x-table.td
                            :status="$replace->status"
                            :status_type="$replace->status == 'pending' || 'processing' ? 'warning' : 'success'"
                    />
                    <x-table.td :subtitle="$replace->remarks ?? 'N/A'"/>
                    <x-table.td :subtitle="$replace->description ?? 'N/A'"/>
                    <x-table.td>
                        {{ $replace->requested_at ? \Carbon\Carbon::parse($replace->requested_at)->diffForHumans() : '' }}
                    </x-table.td>
                    <x-table.td>
                        {{ $replace->completed_at ? \Carbon\Carbon::parse($replace->completed_at)->diffForHumans() : '' }}
                    </x-table.td>
                    <x-table.td>
                        {{ $replace->updated_at ? \Carbon\Carbon::parse($replace->updated_at)->diffForHumans() : '' }}
                    </x-table.td>
                    <x-table.td>
                        {{ $replace->created_at ? \Carbon\Carbon::parse($replace->created_at)->diffForHumans() : '' }}
                    </x-table.td>
                </tr>
            @empty
                <x-table.td class="text-center" colspan="7">No data found.</x-table.td>
            @endforelse
        </x-slot:tbody>
    </x-table>
    <!-- Replace History End Table -->
</div>
