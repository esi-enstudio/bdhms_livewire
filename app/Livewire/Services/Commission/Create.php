<?php

namespace App\Livewire\Services\Commission;

use App\Livewire\Forms\CommissionForm;
use App\Models\Commission;
use App\Models\House;
use App\Models\Retailer;
use App\Models\Rso;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public CommissionForm $form;
    public bool $isManagerDisable = false;

    /**
     * @throws ValidationException
     */
    public function updated($fields, $value): void {
        $this->validateOnly($fields);

        // Reset field when house change
        if ($fields === 'form.house_id') {
            $this->form->user_manager_id = null;
            $this->form->user_supervisor_id = null;
            $this->form->rso_id = null;
            $this->form->retailer_id = null;
        }
    }

    /**
     * @throws ValidationException
     */
    public function store(){

        // Validating fields
        $attr = $this->form->validate();

        dd($attr);

        $attr['status'] = 'pending';

        Commission::create($attr);

        // Session flash message
        session()->flash('message','New commission added successfully!');

        // Redirect to rso list
        return $this->redirectRoute('commission.index', navigate: true);
    }


    public function render(): Factory|View|Application {

        $houses = House::select('id','code','name')->where('status','active')->get();
        $managers = User::select('id','name','phone')
                ->role('manager')
                ->whereHas('houses', fn($query) => $query->where('houses.id', $this->form->house_id))
                ->get();
        $supervisors = User::select('id','name','phone')
                ->role('supervisor')
                ->whereHas('houses', fn($query) => $query->where('houses.id', $this->form->house_id))
                ->get();
        $rsos = Rso::select('id','rso_code','itop_number')
                ->where('house_id', $this->form->house_id)
                ->get();
        $retailers = Retailer::select('id','code','itop_number')
                ->where('house_id', $this->form->house_id)
                ->get();


        return view('livewire.services.commission.create', [
                'houses' => $houses,
                'managers' => $managers,
                'supervisors' => $supervisors,
                'rsos' => $rsos,
                'retailers' => $retailers,
        ])->title('Add New');
    }
}
