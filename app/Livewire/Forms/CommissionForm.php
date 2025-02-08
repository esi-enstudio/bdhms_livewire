<?php

namespace App\Livewire\Forms;

use AllowDynamicProperties;
use Livewire\Form;

#[AllowDynamicProperties] class CommissionForm extends Form
{
    public $id;

    public $house_id;
    public $user_manager_id;
    public $user_supervisor_id;
    public $rso_id;
    public $retailer_id;
    public $for;
    public $type;
    public $name;
    public $month;
    public $amount;
    public $receive_date;
    public $description;
    public $remarks;
    public $status;

    public function rules(): array
    {
        return [
            'house_id'              => ['nullable'],
            'user_manager_id'       => ['nullable'],
            'user_supervisor_id'    => ['nullable'],
            'rso_id'                => ['nullable'],
            'retailer_id'           => ['nullable'],
            'for'                   => ['required'],
            'type'                  => ['required'],
            'name'                  => ['required'],
            'month'                 => ['required'],
            'amount'                => ['required'],
            'receive_date'          => ['required'],
            'description'           => ['nullable'],
            'remarks'               => ['nullable'],
            'status'                => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'for.required' => 'The commission for is required.',
        ];
    }
}
