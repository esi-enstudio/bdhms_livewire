<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public UserForm $form;
    public string $search = '';
    public string $role = ''; // Default empty to show all roles
    public string $status = ''; // Default empty to show all roles
    public array $selectedUsers = []; // Holds selected user IDs
    public bool $selectAll = false; // For "Select All" checkbox


//    protected array $queryString = [
//        'search' => ['except' => ''],
//        'role' => ['except' => ''],
//        'status' => ['except' => ''],
//    ];

    // Reset pagination when search or filters change
    public function updatedSearch(): void
    {
        $this->resetPage();
    }
    public function updatedRole(): void
    {
        $this->resetPage();
    }
    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function delete(User $user): void
    {
        // Delete the user's avatar if it exists
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Add authorization

        // Delete the user
        $user->delete();

        session()->flash('message', 'User deleted successfully!');
    }

    // Bulk actions
    // Automatically toggle the select all checkbox based on individual selections
    public function updatedSelectedUsers(): void
    {
        $this->selectAll = count($this->selectedUsers) === User::count();
    }

    // Select/Deselect all users
    public function updatedSelectAll($value): void
    {
        $this->selectedUsers = $value ? User::pluck('id')->toArray() : [] ;
    }

    // Bulk delete users
    public function deleteSelected(): void
    {
        // Find users to delete
        $users = User::whereIn('id', $this->selectedUsers)->get();

        foreach ($users as $user) {
            // Delete avatar if it exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Delete the user
            $user->delete();
        }

        // Clear selection and show success message
        $this->resetSelection();
        session()->flash('message', 'Selected users deleted successfully!');
    }

    // Bulk update status to active
    public function activateSelected(): void
    {
        User::whereIn('id', $this->selectedUsers)->update(['status' => 'active']);
        $this->resetSelection();
        session()->flash('message', 'Selected users are active successfully!');
    }

    // Bulk update status to inactive
    public function deactivateSelected(): void
    {
        User::whereIn('id', $this->selectedUsers)->update(['status' => 'inactive']);
        $this->resetSelection();
        session()->flash('message', 'Selected users are inactive successfully!');
    }

    // Reset the selection
    public function resetSelection(): void
    {
        $this->selectedUsers = [];
        $this->selectAll = false;
    }
    // Bulk actions end


    public function render(): Factory|View|Application
    {
        // Query with search, filter, and pagination
        $users = User::query()
                ->search($this->search)
                ->when($this->role, fn($query) => $query->where('role', $this->role))
                ->when($this->status, fn($query) => $query->where('status', $this->status))
                ->latest()
                ->paginate(4);

        return view('livewire.user.index', [
            'users' => $users
        ])->title('All Users');
    }
}
