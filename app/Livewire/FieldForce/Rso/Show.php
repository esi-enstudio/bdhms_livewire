<?php

namespace App\Livewire\FieldForce\Rso;

use App\Livewire\Forms\RsoForm;
use App\Models\House;
use App\Models\Rso;
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
    public RsoForm $form;
    public $document;
    public $rsoName;

    public function mount(Rso $rso): void
    {
        $this->rsoName = $rso->user->name ?? '';
        $this->form->rsoId = $rso->id;
        $this->document = $rso->documents;
        $this->form->fill( collect($rso->toArray())->except('documents')->toArray() );
    }

    #[Computed]
    public function houses()
    {
        return House::where('status', 'active')->get();
    }

    #[Computed]
    public function users()
    {
        $houseId = $this->form->house_id;

        // Load users for the selected house
        return User::whereHas('houses', function ($query) use ($houseId) {
            $query->where('houses.id', $houseId);
        })->get();
    }

    public function download(Rso $rso): StreamedResponse
    {
        $filePath = $rso->documents;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($filePath);
    }

    // Delete rso
    public function destroy(Rso $rso)
    {
        // Delete documents if it exists
        if ($rso->documents && Storage::disk('public')->exists($rso->documents)) {
            Storage::disk('public')->delete($rso->documents);
        }

        // Delete the rso
        $rso->delete();

        // Session message
        session()->flash('message', 'Rso deleted successfully!');

        // Redirect
        return $this->redirectRoute('rso.index', navigate: true);
    }


    public function render(): Application|Factory|View
    {
        return view('livewire.field-force.rso.show')->title('Rso Details');
    }
}
