<?php

namespace App\Livewire\Services\ItopReplace;

use App\Models\ItopReplace;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public $replace;


    public function mount(ItopReplace $replace): void
    {
        $this->replace = $replace;
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(ItopReplace $replace): null
    {
        $this->authorize('delete replace');

        $replace->delete();

        // Session flash message
        session()->flash('message','Record deleted successfully!');

        // Redirect to rso list
        return $this->redirectRoute('itopReplace.index', navigate: true);
    }

    public function render(): Factory|View|Application {
        return view('livewire.services.itop-replace.show', [
            'histories' => ItopReplace::query()
                    ->where('sim_serial', 'LIKE', "%{$this->search}%")
                    ->where('retailer_id', $this->replace->retailer_id)
                    ->latest()
                    ->paginate(5),
        ])->title('Details Information');
    }
}
