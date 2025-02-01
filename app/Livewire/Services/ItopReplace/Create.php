<?php

namespace App\Livewire\Services\ItopReplace;

use App\Livewire\Forms\ItopReplaceForm;
use App\Models\House;
use App\Models\Retailer;
use App\Models\Rso;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Create extends Component
{
    public ItopReplaceForm $form;
    public $houseId;
    public $itop_number;

    /**
     * @throws ValidationException
     */
    public function updated( $fields): void {
        $this->validateOnly($fields);

    }

    /**
     * @throws ValidationException
     */
    public function store(){
        // Validating fields
        $attr = $this->form->validate();
    }



    public function render(): Factory|View|Application
    {
        $retailers = '';
        switch (Auth::user()->role){
            case 'admin':
                $retailers = Retailer::where('enabled', 'Y')->get();
                break;

            case 'rso':
                $rsoID = Rso::firstWhere('user_id', Auth::id())->id;
                $retailers = Retailer::where([['enabled', 'Y'],['rso_id', $rsoID]])->get();
                break;
        }

        return view('livewire.services.itop-replace.create', [
            'retailers' => $retailers,
        ])->title('Add New');
    }
}
