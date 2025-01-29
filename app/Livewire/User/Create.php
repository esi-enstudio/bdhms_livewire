<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\House;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public UserForm $form;
    public bool $isCreate = false;

    public string $avatarPreview = 'https://preline.co/assets/img/160x160/img1.jpg'; // For image preview
    public string $fileName = 'Upload Photo'; // For file name
    public $houses;

    public function mount(): void
    {
        $this->houses = House::query()->where('status', 'active')->get();
        $this->isCreate = true;
        $this->avatarKey = uniqid();
    }

    /**
     * @throws ValidationException
     */
    public function updated( $propsName ): void
    {
        $this->validateOnly($propsName);
    }

    public function resetAvatar(): void {
        $this->form->avatar = null;
        $this->fileName = 'Upload Photo';
        $this->avatarPreview = 'https://preline.co/assets/img/160x160/img1.jpg';
    }

    public function updatedFormAvatar(): void
    {
        // Preview the uploaded image
        if ($this->form->avatar) {
            $this->avatarPreview = $this->form->avatar->temporaryUrl();
            $this->fileName = $this->form->avatar->getClientOriginalName();
        }
    }

    /**
     * @throws ValidationException
     */
    public function store()
    {
        $attr = $this->form->validate();

        // Handle avatar upload
        if ($this->form->avatar) {
            // Store the new photo
            $path = $this->form->avatar->store('avatars', 'public');
            $attr['avatar'] = $path;
        }

        // Create the user
        $user = User::create(collect($attr)->except(['userId','password_confirmation','roles','selectStatus','passwordFields'])->toArray());

        // Sync selected houses
        $user->houses()->sync($this->form->houses);

        // Session flash message
        session()->flash('message', 'User created successfully!');

        // Redirect user
        return $this->redirectRoute('user.index', navigate: true);
    }


    public function render(): Factory|View|Application
    {
        return view('livewire.user.create')->title('Add New');
    }
}
