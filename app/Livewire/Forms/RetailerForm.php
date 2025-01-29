<?php

namespace App\Livewire\Forms;

use AllowDynamicProperties;
use Livewire\Form;

#[AllowDynamicProperties] class RetailerForm extends Form
{
    public $id;

    // Retailer Information
    public $house_id;
    public $code;
    public $name;
    public $type;
    public $enabled;
    public $service_point;
    public $category;

    // User/Owner Information
    public $user_id;
    public $owner_name;
    public $owner_number;
    public $itop_number;
    public $dob;
    public $nid;

    // Location Information
    public $division;
    public $district;
    public $thana;
    public $address;
    public $lat;
    public $long;

    // Technical Information
    public $sso;
    public $bts_code;

    // Additional Information
    public $description;
    public $remarks;
    public $document;




    public function rules(): array
    {
        return [
            // Retailer Information
                'house_id' => 'required',
                'code' => 'required|string|max:10|starts_with:R|unique:retailers,code'.$this->id,
                'name' => 'required|string|max:150',
                'type' => 'required|string|max:50', // Adjust the allowed values as needed
                'enabled' => 'required|in:Y,N',
                'service_point' => 'nullable|string|max:150',
                'category' => 'nullable|string|max:100',

            // User/Owner Information
                'user_id' => 'required|exists:users,id', // Assuming optional linking to a 'users' table
                'owner_name' => 'nullable|string|max:150',
                'owner_number' => 'nullable|string|digits:11|unique:retailers,owner_number'.$this->id,
                'itop_number' => 'required|string|digits:11|unique:retailers,itop_number'.$this->id,
                'dob' => 'nullable|date|before:today',
                'nid' => ['nullable','numeric','regex:/^\d{10}$|^\d{13}$|^\d{17}$/','unique:retailers,nid'. $this->id],

            // Location Information
                'division' => 'nullable|string|max:50',
                'district' => 'nullable|string|max:50',
                'thana' => 'nullable|string|max:50',
                'address' => 'required|string|max:255',
                'lat' => 'nullable|numeric',
                'long' => 'nullable|numeric',

            // Technical Information
                'sso' => 'required|string|in:Y,N',
                'bts_code' => 'nullable|string|max:50',

            // Additional Information
                'description' => 'nullable|string|max:255',
                'remarks' => 'nullable|string|max:150',
                'document' => 'nullable|file|mimes:jpg,jpeg,png|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            // Retailer Information
                'house_id.required' => 'The houses is required.',
                'house_id.exists' => 'The selected houses does not exist.',
                'code.required' => 'The retailer code is required.',
                'code.string' => 'The retailer code must be a valid string.',
                'code.max' => 'The retailer code may not exceed 50 characters.',
                'code.unique' => 'The retailer code must be unique.',
                'name.required' => 'The retailer name is required.',
                'name.string' => 'The retailer name must be a valid string.',
                'name.max' => 'The retailer name may not exceed 255 characters.',
                'type.required' => 'The retailer type is required.',
                'type.in' => 'The selected retailer type is invalid.',
                'enabled.required' => 'The enabled status is required.',
                'enabled.boolean' => 'The enabled status must be true or false.',
                'category.required' => 'The retailer category is required.',

            // User/Owner Information
                'owner_name.required' => 'The owner name is required.',
                'owner_name.string' => 'The owner name must be a valid string.',
                'owner_name.max' => 'The owner name may not exceed 255 characters.',
                'owner_number.required' => 'The owner contact number is required.',
                'owner_number.string' => 'The owner contact number must be a valid string.',
                'owner_number.regex' => 'The owner contact number format is invalid.',
                'owner_number.unique' => 'The owner contact number must be unique.',
                'dob.date' => 'The date of birth must be a valid date.',
                'dob.before' => 'The date of birth must be a past date.',
                'nid.unique' => 'The National ID must be unique.',
                'nid.max' => 'The National ID may not exceed 25 characters.',
                'nid.regex' => 'The NID must be 10, 13, or 17 digits.',

            // Location Information
                'division.required' => 'The division is required.',
                'division.string' => 'The division must be a valid string.',
                'district.required' => 'The district is required.',
                'district.string' => 'The district must be a valid string.',
                'thana.required' => 'The thana is required.',
                'thana.string' => 'The thana must be a valid string.',
                'lat.numeric' => 'The latitude must be a valid number.',
                'lat.between' => 'The latitude must be between -90 and 90.',
                'long.numeric' => 'The longitude must be a valid number.',
                'long.between' => 'The longitude must be between -180 and 180.',

            // Technical Information
                'sso.string' => 'The SSO must be a valid string.',
                'bts_code.string' => 'The BTS code must be a valid string.',

            // Additional Information
                'description.string' => 'The description must be a valid string.',
                'remarks.string' => 'The remarks must be a valid string.',
                'document.file' => 'The uploaded document must be a valid file.',
                'document.mimes' => 'The document must be a file of type: jpg, jpeg, png, or pdf.',
                'document.max' => 'The document may not exceed 2 MB.',
        ];
    }
}
