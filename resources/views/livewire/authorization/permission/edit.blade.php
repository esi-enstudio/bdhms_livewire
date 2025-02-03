<x-form
        heading="Update Permission"
        subheading="Modify the permission."
        :cancelBtnUrl="route('permission.index')"
        cancelBtnText="Cancel"
        :action=" (object) [
                'btnType' => 'button',
                'btnText' => 'Save Changes',
            ]"
        submitMethod="update"
>
    <x-form.section>
        <x-form.label>Title</x-form.label>
        <x-form.text-input wire:model.blur="name" error="name" placeholder="Enter permission title"/>
    </x-form.section>
</x-form>
