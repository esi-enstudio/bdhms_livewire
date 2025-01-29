<?php

namespace App\Livewire\Houses;

use App\Livewire\Forms\HouseForm;
use App\Models\House;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Show extends Component
{
    public HouseForm $form;

    public function mount(House $house): void
    {
        $this->form->house = $house;
        $this->form->fill($house->toArray());
    }

    public function destroy(House $house): null {
        $house->delete();

        // Flash message
        session()->flash('message', 'House deleted successfully!');

        // Redirect
        return $this->redirectRoute('houses.index', navigate: true);
    }


    public function render(): Factory|View|Application {
        return view('livewire.houses.show')->title('View Details');
    }
}
