<?php

namespace App\Livewire\Authorization\Role;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public string $name;
    public $role;
    public array $permissions = [];

    public function mount(Role $role): void {
        $this->name = $role->name;
        $this->role = $role;
        $this->permissions = $role->permissions->pluck('name')->toArray();
    }

    protected function rules(): array {
        return [
                'name' => ['required','string','regex:/^[\pL\s]+$/u','max:50','unique:permissions'],
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

    public function update(): null {
        $attr = $this->validate();

        $this->role->update($attr);

        if (!empty($this->permissions))
        {
            $this->role->syncPermissions($this->permissions);
        }else{
            $this->role->syncPermissions([]);
        }

        // Session flash message
        session()->flash('message','Role updated successfully!');

        // Redirect to rso list
        return $this->redirectRoute('role.index', navigate: true);
    }

    public function render(): Factory|View|Application {
        return view('livewire.authorization.role.edit', [
                'permissions_groups' => Permission::all()->groupBy('group_name'),
        ])->title('Update Role');
    }
}
