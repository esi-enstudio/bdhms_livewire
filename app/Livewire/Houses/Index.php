<?php

namespace App\Livewire\Houses;

use App\Models\House;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $status = '';
    public array $selectedRecords = [];
    public bool $selectAll = false;

    // Reset pagination when search or filters change
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    // Automatically toggle the select all checkbox based on individual selections
    public function updatedSelectedRecords(): void
    {
        $this->selectAll = count($this->selectedRecords) === House::count();
    }

    // Select/Deselect all records
    public function updatedSelectAll($value): void
    {
        $this->selectedRecords = $value ? House::pluck('id')->toArray() : [] ;
    }

    // Bulk update status to active
    public function activateSelected(): void
    {
        House::whereIn('id', $this->selectedRecords)->update(['status' => 'active']);
        $this->resetSelection();
        session()->flash('message', 'Selected records are active successfully!');
    }

    // Bulk update status to inactive
    public function deactivateSelected(): void
    {
        House::whereIn('id', $this->selectedRecords)->update(['status' => 'inactive']);
        $this->resetSelection();
        session()->flash('message', 'Selected records are inactive successfully!');
    }

    // Bulk delete
    public function deleteSelected(): void
    {
        // Find users to delete
        $records = House::whereIn('id', $this->selectedRecords)->get();

        foreach ($records as $record) {

            // Delete record
            $record->delete();
        }

        // Clear selection and show success message
        $this->resetSelection();
        session()->flash('message', 'Selected records deleted successfully!');
    }

    // Reset the selection
    public function resetSelection(): void
    {
        $this->selectedRecords = [];
        $this->selectAll = false;
    }

    public function render(): Factory|View|Application {
        // Query with search, filter, and pagination
        $houses = House::query()
                ->search($this->search)
                ->when($this->status, function ($query) {
                    $query->where('status', $this->status);
                })
                ->latest()
                ->paginate(3);

        return view('livewire.houses.index', ['houses' => $houses])->title('All Houses');
    }
}
