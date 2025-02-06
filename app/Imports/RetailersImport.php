<?php

namespace App\Imports;

use App\Models\House;
use App\Models\Retailer;
use App\Models\Rso;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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
            'house_id'      => House::firstWhere('code', $row['distributor_code'])->id,
            'rso_id'        => Rso::firstWhere('itop_number', '0'.$row['rso_number'])->id,
            'code'          => $row['retailer_code'],
            'name'          => Str::title($row['retailer_name']),
            'type'          => $row['retailer_type'],
            'enabled'       => $row['enabled'],
            'service_point' => $row['service_point'],
            'category'      => $row['category'],
            'owner_name'    => Str::title($row['owner_name']),
            'owner_number'  => '0'.$row['contact_no'],
            'itop_number'   => '0'.$row['itopup_number'],
            'dob'           => Carbon::parse($row['dob'])->format('Y-m-d'),
            'nid'           => $row['nid'],
            'division'      => Str::title($row['division']),
            'district'      => Str::title($row['district']),
            'thana'         => Str::title($row['thana']),
            'address'       => $row['address'],
            'lat'           => $row['latitude'],
            'long'          => $row['longitude'],
            'sso'           => $row['sim_seller'],
            'description'   => $row['description'],
            'remarks'       => $row['remarks'],
        ]);
    }

    public function chunkSize(): int
    {
        return 2000;
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
