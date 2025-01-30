<?php

namespace App\Livewire\Retailer;

use App\Exports\RetailersExport;
use App\Models\Retailer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Index extends Component
{
    // Pagination Traits
    use WithPagination, WithoutUrlPagination;

    // Properties
    public string $search = '';
    public string $status = '';
    public $enabled;
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
        $this->selectAll = count($this->selectedRecords) === Retailer::count();
    }

    // Select-Deselect all records
    public function updatedSelectAll($value): void
    {
        $this->selectedRecords = $value ? Retailer::pluck('id')->toArray() : [] ;
    }

    // Bulk update status to active
    public function activateSelected(): void
    {
        Retailer::whereIn('id', $this->selectedRecords)->update(['status' => 'active']);
        $this->resetSelection();
        session()->flash('message', 'Selected retailers are active successfully!');
    }

    // Bulk update status to inactive
    public function deactivateSelected(): void
    {
        Retailer::whereIn('id', $this->selectedRecords)->update(['status' => 'inactive']);
        $this->resetSelection();
        session()->flash('message', 'Selected retailers are inactive successfully!');
    }

    // Delete multiple records
    public function deleteSelected(): void
    {
        // Find users to delete
        $records = Retailer::whereIn('id', $this->selectedRecords)->get();

        foreach ($records as $record) {
            // Delete document if it exists
            if ($record->documents && Storage::disk('public')->exists($record->documents)) {
                Storage::disk('public')->delete($record->documents);
            }

            // Delete the record
            $record->delete();
        }

        // Clear selection and show success message
        $this->resetSelection();

        // Session message
        session()->flash('message', 'Selected records deleted successfully!');
    }

    // Delete single record
    public function destroy(Retailer $retailer): void
    {
        // Delete the document if it exists
        if ($retailer->document && Storage::disk('public')->exists($retailer->document)) {
            Storage::disk('public')->delete($retailer->document);
        }

        // Add authorization

        // Delete the record
        $retailer->delete();

        session()->flash('message', 'Record deleted successfully!');
    }

    // Reset the selection
    public function resetSelection(): void
    {
        $this->selectedRecords = [];
        $this->selectAll = false;
    }


    public function exportExcel(): BinaryFileResponse
    {
        return Excel::download(new RetailersExport(), 'retailers.xlsx');
    }

    public function render(): Factory|View|Application
    {
        // Query with search, filter, and pagination
        $retailers = Retailer::query()
            ->search($this->search)
            ->when($this->status, function ($query) {
                $query->where('enabled', $this->status);
            })
            ->latest()
            ->paginate(5);

        return view('livewire.retailer.index', [
            'retailers' => $retailers,
        ])->title('Retailers');
    }
}
