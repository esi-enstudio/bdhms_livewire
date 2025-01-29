<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class HouseForm extends Form
{
    public $house = null;

    public string $code;
    public string $name;
    public string $cluster;
    public string $region;
    public string $district;
    public string $thana;
    public string $email;
    public string $address;
    public string $proprietor_name;
    public string $contact_number;
    public string $poc_name;
    public string $poc_number;
    public string $lifting_date;
    public string $status = 'inactive';
    public ?string $remarks;

    public function rules(): array
    {
        return [
            'code'              => ['required','min:8','max:12','unique:houses,code,' . optional($this->house)->id],
            'name'              => ['required','max:150','string'],
            'cluster'           => ['required','max:50'],
            'region'            => ['required','max:50'],
            'district'          => ['required','max:50'],
            'thana'             => ['required','max:50'],
            'email'             => ['required','lowercase','max:150','email','unique:houses,email,' . optional($this->house)->id],
            'address'           => ['required','max:255'],
            'proprietor_name'   => ['required','max:100'],
            'contact_number'    => ['required','digits:11','starts_with:013,014,015,016,017,018,019','unique:houses,contact_number,' . optional($this->house)->id],
            'poc_name'          => ['required','max:100'],
            'poc_number'        => ['required','digits:11','starts_with:013,014,015,016,017,018,019','unique:houses,poc_number,' . optional($this->house)->id],
            'lifting_date'      => ['required','date'],
            'status'            => ['nullable','in:active,inactive'],
            'remarks'           => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'House code is required.',
            'code.unique' => 'This code is already taken.',
            'name.required' => 'House name is required.',
            'cluster.required' => 'Cluster is required.',
            'region.required' => 'Region is required.',
            'district.required' => 'District is required.',
            'address.required' => 'Address is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already taken.',
            'thana.required' => 'Thana is required.',
            'proprietor_name.required' => 'Proprietor name is required.',
            'poc_name.required' => 'POC name is required.',
            'contact_number.required' => 'Proprietor number is required.',
            'lifting_date.required' => 'Lifting date is required.',
            'poc_number.required' => 'POC number is required.',
            'contact_number.unique' => 'This mobile number is already taken.',
            'poc_number.unique' => 'This mobile number is already taken.',
        ];
    }
}
