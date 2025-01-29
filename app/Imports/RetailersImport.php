<?php

namespace App\Imports;

use App\Models\House;
use App\Models\Retailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class RetailersImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return Model|Retailer|null
     */
    public function model(array $row): Model|Retailer|null {

        return new Retailer([
            'house_id'      => House::firstWhere('code', $row['dd_code'])->id,
            'code'          => $row['retailer_code'],
            'name'          => $row['retailer_name'],
            'itop_number'   => '0'.$row['itop_number'],
            'address'       => $row['address'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
                'code' => 'required|string|max:10|starts_with:R|unique:retailers,code',
                'name' => 'required|string|max:150',

            // Above is alias for as it always validates in batches
                '*.code' => 'required|string|max:10|starts_with:R|unique:retailers,code',
                '*.name' => 'required|string|max:150',
        ];
    }
}
