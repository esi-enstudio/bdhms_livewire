<?php

namespace App\Livewire\Retailer;

use App\Imports\RetailersImport;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;

    public $import_file;

    protected array $rules = [
            'import_file' => ['required','file','mimes:csv,txt'],
    ];

    protected function messages(): array {
        return [
                'import_file.file' => 'The uploaded file must be valid.',
                'import_file.mimes' => 'Only CSV files are allowed.',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function updated($importField): void {
        $this->validateOnly($importField);
    }

    public function import() {
        $this->validate();

        Excel::import(new RetailersImport, $this->import_file->getRealPath());

        session()->flash('message', 'Retailers imported successfully!');

        // Reset file input
        $this->reset('import_file');

        return $this->redirectRoute('retailer.index', navigate: true);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.retailer.import')->title('Import');
    }
}
