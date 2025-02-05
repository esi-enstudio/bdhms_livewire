<?php

namespace App\Livewire\Authorization\Permission;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

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
    public function destroy(Permission $permission): void
    {
        $this->authorize('delete permission');

        $permission->delete();

        // Session flash message
        session()->flash('message','Permission deleted successfully!');
    }

    // Delete ALL

    /**
     * @throws AuthorizationException
     */
    public function deleteAll(): void {

        $this->authorize('delete all permission');

        // Delete records
        Permission::truncate();

        session()->flash('message', 'All permissions have been deleted successfully.');
    }

    #[Computed]
    public function permissions(): LengthAwarePaginator {
        return Permission::query()->where('name', 'LIKE', "%{$this->search}%")->latest()->paginate(5);
    }

    public function render(): Factory|View|Application {
        return view('livewire.authorization.permission.index', ['allPermissionCount' => Permission::count()])->title('All Permissions');
    }
}
