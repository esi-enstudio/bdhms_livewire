<?php

namespace App\Livewire\Services\ItopReplace;

use App\Livewire\Forms\ItopReplaceForm;
use App\Models\House;
use App\Models\Retailer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Create extends Component
{
    public ItopReplaceForm $form;
    public $houseId;

    /**
     * @throws ValidationException
     */
    public function updated( $fields): void {
        $this->validateOnly($fields);

        if ($fields === 'houseId') {
            $this->form->retailer_id = null;
        }
    }

    #[Computed]
    public function houses(){
        return House::where('status', 'active')->get();
    }

    #[Computed]
    public function retailers(){
        return Retailer::where('enabled', 'Y')
            ->whereHas('house', fn($query) => $query->where('house_id', $this->houseId))
            ->get();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.services.itop-replace.create')->title('Add New');
    }
}
