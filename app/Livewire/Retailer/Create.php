<?php

namespace App\Livewire\Retailer;

use App\Livewire\Forms\RetailerForm;
use App\Models\House;
use App\Models\Retailer;
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

    public RetailerForm $form;

    /**
     * Real time validation
     * @throws ValidationException
     */
    public function updated($fields): void {
        $this->validateOnly($fields);

        if ($fields === 'form.house_id') {
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
        if ($this->form->document) {
            // Store the new document
            $path = $this->form->document->store('retailer/documents', 'public');
            $attr['document'] = $path;
        }

        // Create new rso
        Retailer::create($attr);

        // Session flash message
        session()->flash('message', 'Retailer created successfully!');

        // Redirect to rso list page
        return $this->redirectRoute('retailer.index', navigate: true);
    }



    public function render(): Factory|View|Application
    {
        $availableUsers = Retailer::whereNotNull('user_id')->pluck('user_id');

        return view('livewire.retailer.create', [
            'houses' => House::where('status', 'active')->get(),
            'users' => User::where([['status', 'active'],['role', 'retailer']])
                    ->whereNotIn('id', $availableUsers)
                    ->whereHas('houses', fn($query) => $query->where('houses.id', $this->form->house_id))
                    ->get(),
        ])->title('Add New');
    }
}
