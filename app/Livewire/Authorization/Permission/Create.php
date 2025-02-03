<?php

namespace App\Livewire\Authorization\Permission;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public string $name;
    public string $group_name;

    protected function rules(): array {
        return [
                'name' => ['required','string','regex:/^[\pL\s]+$/u','max:50','unique:permissions'],
                'group_name' => ['required','string','regex:/^[\pL\s]+$/u','max:50'],
        ];
    }

    protected function messages(): array {
        return [
                'name.regex' => 'Only strings are allowed.',
                'group_name.regex' => 'Only strings are allowed.',
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

        Permission::create($attr);

        // Session flash message
        session()->flash('message','New permission created successfully!');

        // Redirect to rso list
        return $this->redirectRoute('permission.index', navigate: true);
    }

    public function render(): Factory|View|Application {
        return view('livewire.authorization.permission.create')->title('Add New');
    }
}
