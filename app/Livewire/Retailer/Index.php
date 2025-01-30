<?php

namespace App\Livewire\Retailer;

use App\Exports\RetailersExport;
use App\Models\Retailer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    // Pagination Traits
    use WithPagination, WithoutUrlPagination;

    // Properties
    public string $search = '';
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
            if ($record->document && Storage::disk('public')->exists($record->document)) {
                Storage::disk('public')->delete($record->document);
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

    // Delete ALL
    public function deleteAll(): void {

        foreach (Retailer::all() as $retailer) {
            // Delete document if it exists
            if ($retailer->document && Storage::disk('public')->exists($retailer->document)) {
                Storage::disk('public')->delete($retailer->document);
            }
        }

        // Delete records
        Retailer::truncate();

        session()->flash('message', 'All retailers have been deleted successfully.');
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

    public function download(Retailer $retailer): StreamedResponse {
        // Ensure the file exists
        if (!Storage::disk('public')->exists($retailer->document)) {
            session()->flash('error', 'File not found.');
        }

        // Stream the file for download
        return Storage::disk('public')->download($retailer->document);
    }

    #[Computed]
    public function retailers()
    {
        return Retailer::query()->search($this->search)->latest()->paginate(5);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.retailer.index', ['allRetailerCount' => Retailer::count()])->title('Retailers');
    }
}