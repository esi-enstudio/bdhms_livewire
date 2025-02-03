<?php

namespace App\Livewire\Authorization\Role;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

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

    public function destroy(Role $role): void
    {
        $role->delete();

        // Session flash message
        session()->flash('message','Role deleted successfully!');
    }

    // Delete ALL
    public function deleteAll(): void {

        // Delete records
        Role::truncate();

        session()->flash('message', 'All roles have been deleted successfully.');
    }

    #[Computed]
    public function roles(): LengthAwarePaginator {
        return Role::query()->where('name', 'LIKE', "%{$this->search}%")->latest()->paginate(5);
    }


    public function render(): Factory|View|Application {
        return view('livewire.authorization.role.index', ['allRoleCount' => Role::count()])->title('All Roles');
    }
}
