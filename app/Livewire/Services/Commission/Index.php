<?php

namespace App\Livewire\Services\Commission;

use App\Models\Commission;
use App\Models\Rso;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    // Pagination Traits
    use WithPagination, WithoutUrlPagination;

    // Properties
    public string $search = '';

    // Reset pagination when search or filters change
    public function updatedSearch(): void
    {
        $this->resetPage();
    }


    /**
     * @throws AuthorizationException
     */
    public function destroy(Commission $commission): void
    {
        $this->authorize('delete commission');

        $commission->delete();

        // Session flash message
        session()->flash('message','Record deleted successfully!');
    }

    /**
     * Delete ALL
     * @throws AuthorizationException
     */
    public function deleteAll(): void {

        $this->authorize('delete all commission');

        // Delete records
        Commission::truncate();

        session()->flash('message', 'All records have been deleted successfully.');
    }

    #[Computed]
    public function commissions(){
        if (Auth::user()->hasRole('super admin')){
            return Commission::query()->search($this->search)->latest()->paginate(5);
        }elseif(Auth::user()->hasRole('rso')){
            $rsoId = Rso::firstWhere('user_id', Auth::id())->id;
            return Commission::query()->search($this->search)->where('rso_id', $rsoId)->latest()->paginate(5);
        }

        return false;
    }

    public function render(): Factory|View|Application {

        return view('livewire.services.commission.index', ['allCommissionCount' => Commission::count()])->title('Commissions');
    }
}
