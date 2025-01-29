<?php

namespace App\Livewire\Retailer;

use App\Livewire\Forms\RetailerForm;
use App\Models\House;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Show extends Component
{
    public RetailerForm $form;
    public $document;
    public $retailerName;

    public function mount(Retailer $retailer): void
    {
        $this->retailerName = $retailer->user->name;
        $this->form->id = $retailer->id;
        $this->document = $retailer->document;
        $this->form->fill( collect($retailer->toArray())->except('document')->toArray() );
    }

    #[Computed]
    public function houses()
    {
        return House::where('status', 'active')->get();

    }

    #[Computed]
    public function users()
    {
        // Load users for the selected house
        return User::whereHas('houses', fn($query) => $query->where('houses.id', $this->form->house_id))->get();
    }

    public function download(Retailer $retailer): StreamedResponse {

        if (!Storage::disk('public')->exists($retailer->document)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($retailer->document);
    }

    // Delete rso
    public function destroy(Retailer $retailer)
    {
        // Delete documents if it exists
        if ($retailer->document && Storage::disk('public')->exists($retailer->document)) {
            Storage::disk('public')->delete($retailer->document);
        }

        // Delete the rso
        $retailer->delete();

        // Session message
        session()->flash('message', 'Retailer deleted successfully!');

        // Redirect
        return $this->redirectRoute('retailer.index', navigate: true);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.retailer.show')->title('Retailer Details');
    }
}
