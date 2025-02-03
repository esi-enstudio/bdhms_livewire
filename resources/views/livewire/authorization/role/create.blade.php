<div>
    <x-form
            heading="Add New Role"
            subheading="Fill in the details below to make a role."
            :cancelBtnUrl="route('role.index')"
            cancelBtnText="Cancel"
            :action=" (object) [
                'btnType' => 'button',
                'btnText' => 'Create role',
            ]"
            submitMethod="store"
    >
        <x-form.section>
            <x-form.label>Title</x-form.label>
            <x-form.text-input wire:model.blur="name" error="name" placeholder="Enter role title"/>

            <x-form.label>Permissions</x-form.label>
            <div class="sm:col-span-9">
                <div class="grid grid-cols-2 gap-6">
                    @foreach($permissions_groups as $groupName => $permissions)
                    <div class="grid gap-2">
                        <p class="font-semibold">{{ Str::title($groupName) }}</p>
                        @if($permissions->isNotEmpty())
                            @foreach($permissions as $permission)
                                <x-checkbox-input wire:model.live="permissions" value="{{ $permission->name }}" label="{{ Str::title($permission->name) }}" id="{{ $permission->id }}"/>
                            @endforeach
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </x-form.section>
    </x-form>
</div>
