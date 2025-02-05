<?php

namespace App\Livewire\Houses;

use App\Livewire\Forms\HouseForm;
use App\Models\House;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Edit extends Component
{
    public HouseForm $form;

    public function mount(House $house): void
    {
        $this->form->house = $house;
        $this->form->fill($house->toArray());
    }

    /**
     * Update information
     * @throws ValidationException
     * @throws AuthorizationException
     */
    public function update() {

        $this->authorize('edit house');

        // Validating fields
        $attr = $this->form->validate();

        // Update records
        $this->form->house->update($attr);

        // Flash message
        session()->flash('message', 'Information updated successfully!');

        // Redirect
        return $this->redirectRoute('houses.index', navigate: true);
    }


    /**
     * Render view page.
     */
    public function render(): Factory|View|Application
    {
        return view('livewire.houses.edit')->title('Update House');
    }
}
