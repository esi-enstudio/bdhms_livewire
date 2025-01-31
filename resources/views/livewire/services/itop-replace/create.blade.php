<div>
    <x-form
        heading="Make a Request"
        subheading="Fill in the details below to make a replacement request."
        :cancelBtnUrl="route('itopReplace.index')"
        cancelBtnText="Cancel"
        :action=" (object) [
                'btnType' => 'button',
                'btnText' => 'Submit Request',
            ]"
        submitMethod="store"
    >

        <x-form.section title="Assign House and User">
            <x-form.label>House</x-form.label>
            <x-form.select-input-sm wire:model.live="houseId">
                <option selected="" value="">Select House</option>
                @forelse($this->houses as $house)
                    <option value="{{ $house->id }}">{{ $house->code.'-'.$house->name }}</option>
                @empty
                    <option>No data found</option>
                @endforelse
            </x-form.select-input-sm>

            <x-form.label>Retailer</x-form.label>
            <x-form.select-input-sm
                wire:model.blur="form.retailer_id"
                error="form.retailer_id"
                :search="true"
            >
                <option selected="" value="">Select Retailer</option>
                <option value="AF" data-hs-select-option='{
    "icon": "<img class=\"inline-block size-4 rounded-full\" src=\"../assets/vendor/svg-country-flags/png100px/af.png\" alt=\"Afghanistan\" />"}'>
                    Afghanistan
                </option>
{{--                @forelse($this->retailers as $retailer)--}}
{{--                    <option value="{{ $retailer->id }}">{{ $retailer->code.'-'.$retailer->itop_number }}</option>--}}
{{--                @empty--}}
{{--                    <option>No data found</option>--}}
{{--                @endforelse--}}
            </x-form.select-input-sm>



{{--            <x-form.select-input-sm wire:model.blur="form.retailer_id" error="form.retailer_id">--}}
{{--                <option selected="" value="">Select Retailer</option>--}}
{{--                @forelse($this->retailers as $retailer)--}}
{{--                    <option value="{{ $retailer->id }}">{{ $retailer->code.'-'.$retailer->itop_number }}</option>--}}
{{--                @empty--}}
{{--                    <option>No data found</option>--}}
{{--                @endforelse--}}
{{--            </x-form.select-input-sm>--}}
        </x-form.section>

        <x-form.section title="Retailer Information">
            <x-form.label>Code</x-form.label>
            <x-form.text-input wire:model.blur="form.code" error="form.code" placeholder="Enter retailer code"/>

            <x-form.label>enabled</x-form.label>
            <x-form.select-input-sm wire:model.blur="form.enabled" error="form.enabled">
                <option selected="" value="">Select Status</option>
                <option value="Y">Enabled</option>
                <option value="N">Disabled</option>
            </x-form.select-input-sm>
        </x-form.section>
    </x-form>
</div>
