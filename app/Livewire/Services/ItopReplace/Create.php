<?php

namespace App\Livewire\Services\ItopReplace;

use App\Livewire\Forms\ItopReplaceForm;
use App\Models\House;
use App\Models\ItopReplace;
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

        $attr['user_id'] = Auth::id();
        $attr['retailer_id'] = $this->form->retailer_id;
        $attr['status'] = 'pending';
        $attr['requested_at'] = now();

        ItopReplace::create(collect($attr)->except('completed_at')->toArray());

        // Session flash message
        session()->flash('message','Replace request placed successfully!');

        // Redirect to rso list
        return $this->redirectRoute('itopReplace.index', navigate: true);
    }



    public function render(): Factory|View|Application
    {
        $retailers = '';

        if ( Auth::user()->hasRole('super admin') ) {
            $retailers = Retailer::where('enabled', 'Y')->get();
        }elseif (Auth::user()->hasRole('rso')){
            $rsoID = Rso::firstWhere( 'user_id', Auth::id() )->id;
            $retailers = Retailer::where( [ [ 'enabled', 'Y' ], [ 'rso_id', $rsoID ] ] )->get();
        }

        return view('livewire.services.itop-replace.create', [
            'retailers' => $retailers,
        ])->title('Add New');
    }
}
