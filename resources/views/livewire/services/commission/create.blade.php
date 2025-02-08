<div>
    <x-validation-errors/>
    <x-form
            heading="Create New Commission"
            subheading="Fill in the details below to create new commission."
            :cancelBtnUrl="route('commission.index')"
            cancelBtnText="Cancel"
            :action=" (object) [
                'btnType' => 'button',
                'btnText' => 'Create',
            ]"
            submitMethod="store"
    >
        <x-form.section>
            <x-form.label>Commission For</x-form.label>
            <x-form.select-input-sm wire:model.live="form.for" error="form.for">
                <option selected="" value="">Commission For</option>
                <option value="DD">DD House</option>
                <option value="Manager">Manager</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Rso">Rso</option>
                <option value="Retailer">Retailer</option>
            </x-form.select-input-sm>

            @if($isHouse)
            <x-form.label>House</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.house_id" error="form.house_id">
                <option selected="" value="">Select House</option>
                @foreach($houses as $house)
                    <option value="{{ $house->id }}">{{ $house->code.' - '.$house->name }}</option>
                @endforeach
            </x-form.select-input-sm>
            @endif

            @if($isManager)
            <x-form.label>Manager</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.user_manager_id" error="form.user_manager_id">
                <option selected="" value="">Select Manager</option>
                @foreach($managers as $manager)
                    <option value="{{ $manager->id }}">{{ $manager->phone.' - '.$manager->name }}</option>
                @endforeach
            </x-form.select-input-sm>
            @endif

            @if($isSupervisor)
            <x-form.label>Supervisor</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.user_supervisor_id" error="form.user_supervisor_id">
                <option selected="" value="">Select Supervisor</option>
                @foreach($supervisors as $supervisor)
                    <option value="{{ $supervisor->id }}">{{ $supervisor->phone.' - '.$supervisor->name }}</option>
                @endforeach
            </x-form.select-input-sm>
            @endif

            @if($isRso)
            <x-form.label>Rso</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.rso_id" error="form.rso_id">
                <option selected="" value="">Select Rso</option>
                @foreach($rsos as $rso)
                    <option value="{{ $rso->id }}">{{ $rso->phone.' - '.$rso->name }}</option>
                @endforeach
            </x-form.select-input-sm>
            @endif

            @if($isRetailer)
            <x-form.label>Retailer</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.retailer_id" error="form.retailer_id">
                <option selected="" value="">Select Retailer</option>
                @foreach($retailers as $retailer)
                    <option value="{{ $retailer->id }}">{{ $retailer->phone.' - '.$retailer->name }}</option>
                @endforeach
            </x-form.select-input-sm>
            @endif

            <x-form.label>Type</x-form.label>
            <x-form.select-input-sm wire:model.live="form.type" error="form.type">
                <option selected="" value="">Commission Type</option>
                <option value="regional_budget">Regional Budget</option>
                <option value="shera_partner">Shera Partner</option>
                <option value="ga">GA</option>
                <option value="roi_support">ROI Support</option>
                <option value="sc_lifting">SC Lifting</option>
                <option value="weekly_activation">Weekly Activation</option>
                <option value="deno">Deno</option>
                <option value="accelerate">Accelerate</option>
                <option value="bundle_booster">Bundle Booster</option>
                <option value="recharge_data_voice_mix">Recharge, Data, Voice, Mix</option>
                <option value="bsp_rent">BSP Rent</option>
                <option value="my_bl_referral">My BL Referral</option>
                <option value="other">Other</option>
            </x-form.select-input-sm>

            <x-form.label>Commission Name</x-form.label>
            <x-form.text-input wire:model.blur="form.name" error="form.name" placeholder="Enter commission name"/>

            <x-form.label>Month</x-form.label>
            <x-form.text-input wire:model.blur="form.month" error="form.month" type="month"/>

            <x-form.label>Net Amount</x-form.label>
            <x-form.text-input wire:model.blur="form.amount" error="form.amount" type="number" placeholder="Enter net amount"/>

            <x-form.label>Receive Date</x-form.label>
            <x-form.text-input wire:model.blur="form.receive_date" error="form.receive_date" type="date"/>

            <x-form.label>Remarks</x-form.label>
            <x-form.text-input wire:model.blur="form.remarks" error="form.remarks" placeholder="Enter remarks"/>

            <x-form.label>Description</x-form.label>
            <x-form.text-input wire:model.blur="form.description" error="form.description" placeholder="Enter description"/>

        </x-form.section>
    </x-form>
</div>
