<?php

namespace App\Livewire\FieldForce\Rso;

use App\Models\House;
use App\Models\Rso;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    // Pagination Traits
    use WithPagination, WithoutUrlPagination;

    // Properties
    public  $search = '';
    public array $selectedRecords = [];
    public bool $selectAll = false;

    // Reset pagination when search or filters change
    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    // Automatically toggle the select all checkbox based on individual selections
    public function updatedSelectedRecords(): void
    {
        $this->selectAll = count($this->selectedRecords) === Rso::count();
    }

    // Select-Deselect all records
    public function updatedSelectAll($value): void
    {
        $this->selectedRecords = $value ? Rso::pluck('id')->toArray() : [] ;
    }

    // Bulk update status to active
    public function activateSelected(): void
    {
        Rso::whereIn('id', $this->selectedRecords)->update(['status' => 'active']);
        $this->resetSelection();
        session()->flash('message', 'Selected rsos are active successfully!');
    }

    // Bulk update status to inactive
    public function deactivateSelected(): void
    {
        Rso::whereIn('id', $this->selectedRecords)->update(['status' => 'inactive']);
        $this->resetSelection();
        session()->flash('message', 'Selected rsos are inactive successfully!');
    }

    // Reset the selection
    public function resetSelection(): void
    {
        $this->selectedRecords = [];
        $this->selectAll = '';
    }


    /**
     * @throws AuthorizationException
     *
     * Delete record
     */
    public function destroy( Rso $rso): void {

        $this->authorize('delete rso');

        // Delete documents if it exists
        if ($rso->documents && Storage::disk('public')->exists($rso->documents)) {
            Storage::disk('public')->delete($rso->documents);
        }

        // Delete the rso
        $rso->delete();

        // Session message
        session()->flash('message', 'Rso deleted successfully!');
    }

    /**
     * @throws AuthorizationException
     */
    public function download( Rso $rso): StreamedResponse {

        $this->authorize('download rso document');

        $filePath = $rso->documents;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($filePath);
    }

    #[Computed]
    public function rsos()
    {
        if (Auth::user()->hasRole('super admin'))
        {
            return Rso::search($this->search)
                ->latest()
                ->paginate(5);
        }

        return Rso::search($this->search)
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);
    }

    public function render(): Factory|View|Application {
        return view('livewire.field-force.rso.index')->title('All Rso');
    }
}
