<?php

namespace App\Livewire\Services\ItopReplace;

use App\Models\ItopReplace;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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

    #[Computed]
    public function replaces()
    {
        return ItopReplace::query()->search($this->search)->latest()->paginate(5);
    }


    public function render(): Factory|View|Application
    {
        return view('livewire.services.itop-replace.index')->title('Itop Replace');
    }
}
