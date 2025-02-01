<?php

namespace App\Livewire\Forms;

use AllowDynamicProperties;
use Livewire\Form;

#[AllowDynamicProperties] class ItopReplaceForm extends Form
{
    public $id;

    public $user_id;
    public $retailer_id;
    public $sim_serial;
    public $balance;
    public $reason;
    public $status;
    public $remarks;
    public $description;
    public $completed_at;
    public $requested_at;

    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'retailer_id' => ['required'],
            'sim_serial' => ['required','numeric','digits:18','unique:itop_replaces,sim_serial'.$this->id],
            'balance' => ['required','numeric'],
            'reason' => ['required','string','max:100'],
            'status' => ['required','string'],
            'remarks' => ['nullable','string','max:150'],
            'description' => ['nullable','string','max:255'],
            'completed_at' => ['nullable','date'],
            'requested_at' => ['nullable','date'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The user is required.',
            'retailer_id.required' => 'The retailer is required.',
            'serial_number.required' => 'The serial number is required.',
            'balance.required' => 'The balance is required.',
            'reason.required' => 'The reason is required.',
        ];
    }
}
