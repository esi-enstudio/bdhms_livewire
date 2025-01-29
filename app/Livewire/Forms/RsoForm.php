<?php

namespace App\Livewire\Forms;

use AllowDynamicProperties;
use Livewire\Form;

#[AllowDynamicProperties] class RsoForm extends Form
{
    public $rsoId;

    // Personal Information
    public $house_id, $user_id, $personal_number,$father_name,$mother_name,$dob,$nid,$religion,$blood_group,$present_address,$permanent_address,$education;

    public ?string $gender;
    public string $status;

    // Employment Information
    public $osrm_code,$employee_code,$rso_code,$itop_number,$pool_number,$market_type,$category,$agency_name,$sr_no,$joining_date,$resign_date,$documents;

    // Financial Information
    public $salary,$bank_account_name,$bank_name,$bank_account_number,$brunch_name,$routing_number;

    // Location Information
    public string|null $division;
    public $district,$thana;

    public function rules(): array
    {
        return [
            'house_id'   => ['required'],
            'user_id'   => ['required'],

//           Personal Information
            'personal_number'   => ['required','digits:11','regex:/^\+?[0-9]{11}$/','unique:rsos,personal_number'. $this->rsoId],
            'father_name'       => ['nullable','string','min:3','max:100','regex:/^[a-zA-Z\s\p{L}\p{M}\'-\'.]+$/u'],
            'mother_name'       => ['nullable','string','min:3','max:100','regex:/^[a-zA-Z\s\p{L}\p{M}\'-]+$/u'],
            'dob'               => ['required','date','before:today','after:01/01/1900','before_or_equal:' . now()->subYears(18)->format('d-m-Y')],
            'nid'               => ['nullable','numeric','regex:/^\d{10}$|^\d{13}$|^\d{17}$/','unique:rsos,nid'. $this->rsoId],
            'religion'          => ['nullable','string','in:islam,hinduism,buddhism,christianity'],
            'blood_group'       => ['nullable','string','in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
            'gender'            => ['nullable','string','in:male,female,other'],
            'present_address'   => ['nullable','string','min:5','max:255','regex:/^[a-zA-Z0-9\s,.\-\/#()]+$/'],
            'permanent_address' => ['nullable','string','min:5','max:255','regex:/^[a-zA-Z0-9\s,.\-\/#()]+$/'],
            'education'         => ['nullable','string','in:JSC,SSC,HSC,Above'],

//           Employment Information
            'osrm_code'     => ['nullable','string','unique:rsos,osrm_code'. $this->rsoId],
            'employee_code' => ['nullable','string','unique:rsos,employee_code'. $this->rsoId],
            'rso_code'      => ['required','string','starts_with:RS','unique:rsos,rso_code'. $this->rsoId],
            'itop_number'   => ['required','digits:11','starts_with:019,014','regex:/^\+?[0-9]{11}$/','unique:rsos,itop_number'. $this->rsoId],
            'pool_number'   => ['required','digits:11','starts_with:019,014','regex:/^\+?[0-9]{11}$/','unique:rsos,pool_number'. $this->rsoId],
            'market_type'   => ['nullable','string'],
            'category'      => ['nullable','string'],
            'agency_name'   => ['nullable','string'],
            'sr_no'         => ['nullable','string','regex:/^SR-[0-9]{2,4}$/','unique:rsos,sr_no'. $this->rsoId],
            'joining_date'  => ['required','date','date_format:Y-m-d','before_or_equal:today','after:2008-01-01'],
            'resign_date'   => ['nullable','date','date_format:Y-m-d','before_or_equal:today','after:joining_date'],
            'documents'     => ['nullable','file','mimes:pdf,doc,docx','max:2048',],

//           Financial Information
            'salary'                => ['nullable','numeric','min:1000','max:500000','regex:/^\\d+(\\.\\d{1,2})?$/'],
            'bank_account_name'     => ['nullable','string'],
            'bank_name'             => ['nullable','string'],
            'bank_account_number'   => ['nullable','numeric','digits_between:8,18','unique:rsos,bank_account_number'. $this->rsoId],
            'brunch_name'           => ['nullable','string'],
            'routing_number'        => ['nullable','numeric'],

//           Location Information
            'division'  => ['nullable','string','max:30'],
            'district'  => ['nullable','string','max:30'],
            'thana'     => ['nullable','string','max:30'],
            'status'    => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
                'house_id' => 'House is required.',
                'user_id' => 'User is required.',
                'father_name.min' => 'The father name must be at least 3 characters.',
                'father_name.max' => 'The father name may not be greater than 100 characters.',
                'father_name.regex' => 'The father name must contain only letters, spaces, hyphens, and apostrophes.',

                'mother_name.min' => 'The mother name must be at least 3 characters.',
                'mother_name.max' => 'The mother name may not be greater than 100 characters.',
                'mother_name.regex' => 'The mother name must contain only letters, spaces, hyphens, and apostrophes.',

                'nid.regex' => 'The NID must be 10, 13, or 17 digits.',
                'dob.before_or_equal' => 'Your Date of Birth indicates you are not yet 18 years old.',
                'religion.in' => 'Please select a valid religion from the list.',
                'blood_group.in' => 'Please select a valid blood group.',
                'gender.in' => 'Please select a valid gender: Male, Female, or Other.',

                'present_address.min' => 'The address must be at least 5 characters long.',
                'present_address.max' => 'The address must not exceed 255 characters.',
                'present_address.regex' => 'The address must contain only [, . - / # ()] characters.',

                'permanent_address.min' => 'The address must be at least 5 characters long.',
                'permanent_address.max' => 'The address must not exceed 255 characters.',
                'permanent_address.regex' => 'The address must contain only [, . - / # ()] characters.',

                'education.in' => 'Please select a valid education level from the list.',
                'rso_code.starts_with' => 'The RSO Code must starts with "RS".',
                'sr_no.regex' => 'The SR Number must follow the format "SR-20".',

                'joining_date.required' => 'The joining date is required.',
                'joining_date.date' => 'The joining date must be a valid date.',
                'joining_date.date_format' => 'The joining date must be in the format YYYY-MM-DD.',
                'joining_date.before_or_equal' => 'The joining date cannot be a future date.',
                'joining_date.after' => 'The joining date must be after January 1, 2009.',

                'resign_date.date' => 'The resignation date must be a valid date.',
                'resign_date.date_format' => 'The resignation date must be in the format YYYY-MM-DD.',
                'resign_date.before_or_equal' => 'The resignation date cannot be a future date.',
                'resign_date.after' => 'The resignation date must be after the joining date.',

                'documents.file' => 'The uploaded file must be valid.',
                'documents.mimes' => 'Only PDF, DOC and DOCX files are allowed.',
                'documents.max' => 'The document must not exceed 2MB in size.',

                'salary.numeric' => 'The salary must be a valid number.',
                'salary.min' => 'The salary must be at least 1,000.',
                'salary.max' => 'The salary must not exceed 500,000.',
                'salary.regex' => 'The salary must be a valid number with up to two decimal places.',

                'bank_account_number.numeric' => 'The bank account number must be a valid number.',
                'bank_account_number.digits_between' => 'The bank account number must be between 8 and 18 digits.',
        ];
    }
}
