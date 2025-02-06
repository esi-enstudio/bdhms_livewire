<?php

namespace App\Livewire\Services\ItopReplace;

use App\Models\ItopReplace;
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
    public function destroy(ItopReplace $replace): void
    {
        $this->authorize('delete replace');

        $replace->delete();

        // Session flash message
        session()->flash('message','Record deleted successfully!');
    }

    // Delete ALL

    /**
     * @throws AuthorizationException
     */
    public function deleteAll(): void {

        $this->authorize('delete all replace');

        // Delete records
        ItopReplace::truncate();

        session()->flash('message', 'All records have been deleted successfully.');
    }

    #[Computed]
    public function replaces()
    {
        if (Auth::user()->hasRole('super admin')){
            return ItopReplace::query()->search($this->search)->latest()->paginate(5);
        }else{
            return ItopReplace::query()->search($this->search)->where('user_id', Auth::id())->latest()->paginate(5);
        }
    }


    public function render(): Factory|View|Application
    {
        return view('livewire.services.itop-replace.index', ['allReplaceCount' => ItopReplace::count()])->title('Itop Replace');
    }
}
