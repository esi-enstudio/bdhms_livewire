<?php

namespace App\Livewire\Services\Commission;

use App\Livewire\Forms\CommissionForm;
use App\Models\Commission;
use App\Models\House;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public CommissionForm $form;
    public bool $isHouse = false;
    public $houses;
    public bool $isManager = false;
    public $managers;
    public bool $isSupervisor = false;
    public $supervisors;
    public bool $isRso = false;
    public $rsos;
    public bool $isRetailer = false;
    public $retailers;

    /**
     * @throws ValidationException
     */
    public function updated($fields, $value): void {
        $this->validateOnly($fields);

        if ($value == 'DD'){
            $this->reset('isManager','isSupervisor','isRso','isRetailer');
            $this->isHouse = true;
            $this->houses = House::select('id','code','name')->where('status','active')->get();
        }elseif ($value == 'Manager'){
            $this->reset('isHouse','isSupervisor','isRso','isRetailer');
            $this->isManager = true;
            $this->managers = User::select('id','name','phone')->role('manager')->get();
        }elseif ($value == 'Supervisor'){
            $this->reset('isHouse','isManager','isRso','isRetailer');
            $this->isSupervisor = true;
            $this->supervisors = User::select('id','name','phone')->role('supervisor')->get();
        }elseif ($value == 'Rso'){
            $this->reset('isHouse','isManager','isSupervisor','isRetailer');
            $this->isRso = true;
            $this->rsos = User::select('id','name','phone')->role('rso')->get();
        }elseif ($value == 'Retailer'){
            $this->reset('isHouse','isManager','isSupervisor','isRso');
            $this->isRetailer = true;
            $this->retailers = User::select('id','name','phone')->role('retailer')->get();
        }
    }

    /**
     * @throws ValidationException
     */
    public function store(){

        // Validating fields
        $attr = $this->form->validate();

        $attr['status'] = 'pending';

        Commission::create($attr);

        // Session flash message
        session()->flash('message','New commission added successfully!');

        // Redirect to rso list
        return $this->redirectRoute('commission.index', navigate: true);
    }


    public function render(): Factory|View|Application {
        return view('livewire.services.commission.create')->title('Add New');
    }
}
