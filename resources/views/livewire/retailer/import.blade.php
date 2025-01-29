<div>
    <x-form
        heading="Import Retailer"
        subheading="Upload and Manage Your Retailer Data Effortlessly"
        :cancelBtnUrl="route('retailer.index')"
        cancelBtnText="Cancel"
        :action=" (object) [
                'btnType' => 'button',
                'btnText' => 'Import',
            ]"
        submitMethod="import"
    >
        <x-form.section>
            <x-form.label>Upload</x-form.label>
            <x-form.file-upload wire:model.live="import_file" error="import_file" accept=".csv,text"/>
        </x-form.section>

    </x-form>
</div>
