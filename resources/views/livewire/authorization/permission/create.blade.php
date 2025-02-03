<div>
    <x-form
            heading="Add New Permission"
            subheading="Fill in the details below to make a permission."
            :cancelBtnUrl="route('permission.index')"
            cancelBtnText="Cancel"
            :action=" (object) [
                'btnType' => 'button',
                'btnText' => 'Create permission',
            ]"
            submitMethod="store"
    >
        <x-form.section>
            <x-form.label>Group By</x-form.label>
            <x-form.text-input wire:model.blur="group_name" error="group_name" placeholder="Enter group name"/>

            <x-form.label>Permission</x-form.label>
            <x-form.text-input wire:model.blur="name" error="name" placeholder="Enter permission title"/>
        </x-form.section>
    </x-form>
</div>
