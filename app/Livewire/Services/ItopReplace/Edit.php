<?php

namespace App\Livewire\Services\ItopReplace;

use App\Livewire\Forms\ItopReplaceForm;
use App\Models\ItopReplace;
use App\Models\Retailer;
use App\Models\Rso;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Edit extends Component
{
    public ItopReplaceForm $form;
    public $retailers = null;
    public $itopReplace;

    public function mount(ItopReplace $replace): void
    {
        $this->form->id = $replace->id;
        $this->itopReplace = $replace;
        $this->form->fill($replace->toArray());
    }

    /**
     * @throws ValidationException
     */
    public function updated( $fields): void {
        $this->validateOnly($fields);
    }

    /**
     * @throws ValidationException
     */
    public function update(){
        // Validating fields
        $attr = $this->form->validate();

        $attr['retailer_id'] = $this->form->retailer_id;

        if ($attr['status'] == 'complete'){
            $attr['completed_at'] = now();
        }else{
            $attr = collect($attr)->except('completed_at')->toArray();
        }

//        dd(collect($attr)->except('requested_at','user_id')->toArray());

        $this->itopReplace->update(collect($attr)->except('requested_at')->toArray());

        // Session flash message
        session()->flash('message','Information updated successfully!');

        // Redirect to rso list
        return $this->redirectRoute('itopReplace.index', navigate: true);
    }

    public function render(): Factory|View|Application {
        if ( Auth::user()->hasRole('super admin')) {
            $this->retailers = Retailer::select('id','itop_number')->where('enabled', 'Y')->get();
        }elseif (Auth::user()->hasRole('rso')){
            $rsoID = Rso::firstWhere( 'user_id', Auth::id() )->id;
            $this->retailers = Retailer::select('id','itop_number')->where( [ [ 'enabled', 'Y' ], [ 'rso_id', $rsoID ] ] )->get();
        }

        return view('livewire.services.itop-replace.edit', ['retailers' => $this->retailers])->title('Update Info');
    }
}
