<?php

namespace App\Livewire\Services\ItopReplace;

use App\Models\ItopReplace;
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

    public function destroy(ItopReplace $replace): void
    {
        $replace->delete();

        // Session flash message
        session()->flash('message','Record deleted successfully!');
    }

    // Delete ALL
    public function deleteAll(): void {

        // Delete records
        ItopReplace::truncate();

        session()->flash('message', 'All records have been deleted successfully.');
    }

    #[Computed]
    public function replaces()
    {
        return ItopReplace::query()->search($this->search)->where('user_id', Auth::id())->latest()->paginate(5);
    }


    public function render(): Factory|View|Application
    {
        return view('livewire.services.itop-replace.index', ['allReplaceCount' => ItopReplace::count()])->title('Itop Replace');
    }
}
