<?php

namespace App\Exports;

use App\Models\Retailer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class RetailersExport implements FromCollection
{
    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return Retailer::all();
    }
}
