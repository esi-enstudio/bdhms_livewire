<?php

namespace App\Livewire\FieldForce\Rso;

use App\Livewire\Forms\RsoForm;
use App\Models\House;
use App\Models\Rso;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public RsoForm $form;

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

    /**
     * @throws ValidationException
     */
    public function store()
    {
        // Validating fields
        $attr = $this->form->validate();

        // Handle documents upload
        if ($this->form->documents) {
            // Store the new document
            $path = $this->form->documents->store('field-force/rso/documents', 'public');
            $attr['documents'] = $path;
        }

        // Create new rso
        Rso::create($attr);

        // Session flash message
        session()->flash('message', 'Rso created successfully!');

        // Redirect to rso list page
        return $this->redirectRoute('rso.index', navigate: true);
    }

    public function render(): Factory|View|Application {
        $availableUsers = Rso::whereNotNull('user_id')->pluck('user_id');
        $houseId = $this->form->house_id;

        return view('livewire.field-force.rso.create', [
            'houses' => House::where('status', 'active')->get(),

            'users' => User::where([['status', 'active'],['role', 'rso']])
                    ->whereNotIn('id', $availableUsers)
                    ->whereHas('houses', fn($query) => $query->where('houses.id', $houseId))->get(),
        ])->title('Add New');
    }
}
