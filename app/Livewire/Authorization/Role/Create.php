<?php

namespace App\Livewire\Authorization\Role;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public string $name;
    public array $permissions = [];

    protected function rules(): array {
        return [
                'name' => ['required','string','regex:/^[\pL\s]+$/u','max:50','unique:roles'],
        ];
    }

    protected function messages(): array {
        return [
                'name.regex' => 'Only strings are allowed.',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function updated($field): void {
        $this->validateOnly($field);
    }

    public function store(): null {
        $attr = $this->validate();

        $role = Role::create($attr);

        if (!empty($this->permissions))
        {
            foreach ($this->permissions as $permission){
                $role->givePermissionTo($permission);
            }
        }

        // Session flash message
        session()->flash('message','New role created successfully!');

        // Redirect to rso list
        return $this->redirectRoute('role.index', navigate: true);
    }


    public function render(): Factory|View|Application {
//        dd(Permission::groupBy('group_name')->orderBy('group_name', 'ASC'));
        return view('livewire.authorization.role.create', [
                'permissions_groups' => Permission::all()->groupBy('group_name'),
        ])->title('Add New');
    }
}
