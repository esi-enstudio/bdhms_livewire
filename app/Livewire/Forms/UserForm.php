<?php

namespace App\Livewire\Forms;

use AllowDynamicProperties;
use Livewire\Attributes\Validate;
use Livewire\Form;

#[AllowDynamicProperties] class UserForm extends Form
{
    public $userId = null;

    public $name;
    public $phone;
    public $email;
    public $role;
    public $status = 'inactive';
    public $password;
    public $password_confirmation;
    public $avatar;
    public $remarks;
    public array $houses = [];

    public function rules(): array
    {
        return [
            'name'                  => ['required','max:150','min:3'],
            'phone'                 => ['required', 'numeric', 'digits:11', 'unique:users,phone,' . $this->userId],
            'email'                 => ['required','lowercase','max:255','email','unique:users,email,' . $this->userId],
            'password'              => $this->userId ? ['nullable','min:8'] : ['required','min:8'],
            'password_confirmation' => $this->userId ? ['nullable','min:8','same:password'] : ['required','min:8','same:password'],
            'role'                  => ['required'],
            'remarks'               => ['nullable'],
            'avatar'                => ['nullable','image','max:1024'],
            'status'                => ['nullable','in:active,inactive'],
            'houses'                => ['required','array'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'phone.required' => 'Phone number is required.',
            'phone.unique' => 'This phone number is already taken.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already taken.',
            'password.required' => 'Password is required.',
            'password_confirmation.required' => 'Confirm password is required.',
            'password_confirmation.same' => 'Confirm password dose not match.',
            'avatar.max' => 'Max 1024 Mb allowed.',
            'role.required' => 'Role is required.',
            'houses.required' => 'Select houses.',
        ];
    }

    public array $roles = [
        ['label' => 'Admin', 'value' => 'admin'],
        ['label' => 'Zm', 'value' => 'zm'],
        ['label' => 'Manager', 'value' => 'manager'],
        ['label' => 'Supervisor', 'value' => 'supervisor'],
        ['label' => 'Rso', 'value' => 'rso'],
        ['label' => 'Retailer', 'value' => 'retailer'],
        ['label' => 'Account', 'value' => 'account'],
    ];

    public array $selectStatus = [
        ['label' => 'Active', 'value' => 'active'],
        ['label' => 'Inactive', 'value' => 'inactive'],
    ];

    public array $passwordFields = [
        ['model' => 'form.password','error' => 'form.password','placeholder' => 'Enter Password','type' => 'password'],
        ['model' => 'form.password_confirmation','error' => 'form.password_confirmation','placeholder' => 'Enter Confirm Password','type' => 'password']
    ];
}
