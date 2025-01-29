<?php

namespace App\Livewire\FieldForce\Rso;

use App\Livewire\Forms\RsoForm;
use App\Models\House;
use App\Models\Rso;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public RsoForm $form;
    public $rso;
    public $document;

    public function mount(Rso $rso): void
    {
        $this->form->rsoId = $rso->id;
        $this->document = $rso->documents;
        $this->rso = $rso;
        $this->form->fill( collect($rso->toArray())->except('documents')->toArray() );
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
        return User::where('status', 'active')
            ->where('role', 'rso')
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

        if ($this->form->documents) {
            // Delete old file
            if ($this->rso->documents && Storage::disk('public')->exists($this->rso->documents)) {
                Storage::disk('public')->delete($this->rso->documents);
            }

            // Save new file
            $path = $this->form->documents->store('field-force/rso/documents','public');
            $attr['documents'] = $path;
        }else{
            $attr = collect($attr)->except('documents','rsoId')->toArray();
        }

        // Update rso information
        $this->rso->update($attr);

        // Session flash message
        session()->flash('message','RS0 updated successfully!');

        // Redirect to rso list
        return $this->redirectRoute('rso.index', navigate: true);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.field-force.rso.edit',[])->title('Update Rso');
    }
}
