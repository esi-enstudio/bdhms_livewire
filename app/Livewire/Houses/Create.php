<?php

namespace App\Livewire\Houses;

use App\Livewire\Forms\HouseForm;
use App\Models\House;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public HouseForm $form;

    /**
     * Real time validation
     * @throws ValidationException
     */
    public function updated($fields): void {
        $this->validateOnly($fields);
    }

    /**
     * Store house information
     * @throws ValidationException
     */
    public function store(): null {
        // Validating fields
        $attr = $this->form->validate();

        // Creating house
        House::create($attr);

        // Flash message
        session()->flash('message', 'New houses created successfully!');

        // Redirect
        return $this->redirectRoute('houses.index', navigate: true);
    }

    /**
     * Render view page.
     */
    public function render(): Factory|View|Application {
        return view('livewire.houses.create')->title('Add New');
    }
}
