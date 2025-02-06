<?php

namespace App\Livewire\Retailer;

use App\Exports\RetailersExport;
use App\Models\Retailer;
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
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
     * Delete single record
     */
    public function destroy(Retailer $retailer): void
    {
        $this->authorize('delete retailer');

        // Delete the document if it exists
        if ($retailer->document && Storage::disk('public')->exists($retailer->document)) {
            Storage::disk('public')->delete($retailer->document);
        }

        // Add authorization

        // Delete the record
        $retailer->delete();

        session()->flash('message', 'Record deleted successfully!');
    }

    /**
     * @throws AuthorizationException
     * Delete ALL
     */
    public function deleteAll(): void {

        $this->authorize('delete all retailer');

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
        if (Auth::user()->hasRole('super admin')){
            return Retailer::query()->select('id','code','name','itop_number','enabled','sso','house_id')->search($this->search)->latest()->paginate(5);
        }

        $rsoId = Rso::firstWhere('user_id', Auth::id())->id;
        return Retailer::query()->search($this->search)->where('rso_id', $rsoId)->latest()->paginate(5);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.retailer.index', ['allRetailerCount' => Retailer::count()])->title('Retailers');
    }
}
