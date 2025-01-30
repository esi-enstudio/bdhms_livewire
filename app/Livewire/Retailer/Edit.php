<?php

namespace App\Livewire\Retailer;

use App\Livewire\Forms\RetailerForm;
use App\Models\House;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Edit extends Component
{
    use WithFileUploads;

    public RetailerForm $form;
    public $retailer;
    public $document;
    public bool $modifyHouseAndUser = false;

    public function mount(Retailer $retailer): void
    {
        $this->form->id = $retailer->id;
        $this->document = $retailer->document;
        $this->form->retailer = $retailer;
        $this->form->fill( collect($retailer->toArray())->except('document')->toArray() );
    }

    public function toggleHouseAndUser(): void {
       $this->modifyHouseAndUser = !$this->modifyHouseAndUser;
    }

    /**
     * @throws ValidationException
     */
    public function updated( $propsName ): void
    {
        $this->validateOnly($propsName);

        if ($propsName === 'form.house_id') {
            $this->form->user_id = null;
        }
    }

    #[Computed]
    public function houses()
    {
        return House::where('status', 'active')->get();
    }

    #[Computed]
    public function users()
    {
        $userId = Retailer::whereNotNull('user_id')->pluck('user_id');
        return User::where('status', 'active')
                ->where('role', 'retailer')
                ->whereNotIn('id', $userId)
                ->whereHas('houses', fn($query) => $query->where('houses.id', $this->form->house_id))
                ->get();
    }

    /**
     * @throws ValidationException
     */
    public function update()
    {
        // Validation
        $attr = $this->form->validate();

        if ($this->form->document) {
            // Delete old file
            if ($this->retailer->document && Storage::disk('public')->exists($this->retailer->document)) {
                Storage::disk('public')->delete($this->retailer->document);
            }

            // Save new file
            $path = $this->form->document->store('retailer/documents','public');
            $attr['document'] = $path;
        }else{
            $attr = collect($attr)->except('document','id')->toArray();
        }

        // Update rso information
        $this->retailer->update($attr);

        // Session flash message
        session()->flash('message','Retailer updated successfully!');

        // Redirect to rso list
        return $this->redirectRoute('retailer.index', navigate: true);
    }

    public function download(Retailer $retailer): StreamedResponse {
        $filePath = $retailer->document;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($filePath);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.retailer.edit')->title('Update Retailer');
    }
}
