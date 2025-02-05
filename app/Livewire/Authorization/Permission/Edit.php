<?php

namespace App\Livewire\Authorization\Permission;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public string $name;
    public $permission;

    public function mount(Permission $permission): void {
        $this->name = $permission->name;
        $this->permission = $permission;
    }

    protected function rules(): array {
        return [
                'name' => ['required','string','regex:/^[\pL\s]+$/u','max:50','unique:permissions,'.$this->permission->id],
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

    /**
     * @throws AuthorizationException
     */
    public function update(): null {

        $this->authorize('edit permission');

        $attr = $this->validate();

        $this->permission->update($attr);

        // Session flash message
        session()->flash('message','Permission updated successfully!');

        // Redirect to rso list
        return $this->redirectRoute('permission.index', navigate: true);
    }

    public function render(): Factory|View|Application {
        return view('livewire.authorization.permission.edit')->title('Update Permission');
    }
}
