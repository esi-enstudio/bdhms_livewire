<div>
    <!-- Page title -->
    <x-title :title="$replace->retailer->itop_number" :subtitle="$replace->sim_serial"/>
    <!-- Page title end -->

    <!-- Search box -->
    <x-searchbox wire:model.live.debounce.500ms="search" placeholder="Search with serial number..."/>
    <!-- Search box end -->

    <div class="dark:bg-blue-400">
        <p>Balance: {{ $replace->balance }}</p>
    </div>

    <!-- Table Section -->
    <x-table
            secondary-btn-text="Back"
            :secondary-btn-link="route('itopReplace.index')"
            :pagination="$histories"
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
            @forelse($histories as $key => $replace)
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
                                :show="route('itopReplace.show', $replace->id)"
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

{{--    <x-form--}}
{{--            :name="$replaceNumber"--}}
{{--            heading="Replace Details"--}}
{{--            subheading="Review and update the specific details of the itop replace as needed."--}}
{{--            :cancelBtnUrl="route('itopReplace.index')"--}}
{{--            cancelBtnText="Cancel"--}}
{{--            :action=" (object) [--}}
{{--                'btnType' => 'link',--}}
{{--                'url' => route('itopReplace.edit', $id), // required if button type is 'link'--}}
{{--                'btnText' => 'Edit',--}}
{{--            ]"--}}
{{--    >--}}
{{--        <x-form.section>--}}
{{--            <p class="sm:col-span-9">Retailer: {{ $replaceNumber }}</p>--}}
{{--            <p class="sm:col-span-9">Sim Serial: {{ $simSerial }}</p>--}}
{{--            <p class="sm:col-span-9">Balance: {{ $balance }}</p>--}}
{{--            <p class="sm:col-span-9">Reason: {{ \Illuminate\Support\Str::title($reason) }}</p>--}}
{{--            <p class="sm:col-span-9">Remarks: {{ $remarks }}</p>--}}
{{--            <p class="sm:col-span-9">Description: {{ $description }}</p>--}}
{{--            <p class="sm:col-span-9">Status: {{ \Illuminate\Support\Str::title($status) }}</p>--}}
{{--        </x-form.section>--}}
{{--    </x-form>--}}
</div>