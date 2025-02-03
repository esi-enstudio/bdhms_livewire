<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\House;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    use WithFileUploads;

    public UserForm $form;
    public $user;
    public array $role = [];
    public bool $isEdit = false;
    public string $avatarPreview = 'https://preline.co/assets/img/160x160/img1.jpg';
    public string $fileName = 'Upload Photo';
    public $houses;
    public string $created;
    public string $createTimesAgo;
    public string $updated;
    public string $updateTimesAgo;

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->form->userId = $user->id;
        $this->form->fill( collect($user->toArray())->except(['avatar','password','password_confirmation'])->toArray() );
        $this->form->fill(['houses' => $user->houses->pluck('id')->toArray()]);
        $this->created = Carbon::parse($user->created_at)->toFormattedDayDateString();
        $this->updated = Carbon::parse($user->updated_at)->toFormattedDayDateString();
        $this->createTimesAgo = Carbon::parse($user->created_at)->diffForHumans();
        $this->updateTimesAgo = Carbon::parse($user->updated_at)->diffForHumans();
        $this->isEdit = true;

        // Get houses
        $this->houses = House::query()->where('status', 'active')->get();

        // Set the avatar preview to the existing image
        $this->avatarPreview = $user->avatar ? Storage::url($user->avatar) : $this->avatarPreview;
    }

    /**
     * @throws ValidationException
     */
    public function updated( $propsName ): void
    {
        $this->validateOnly($propsName);
    }

    public function updatedFormAvatar(): void
    {
        // Preview the uploaded image
        if ($this->form->avatar) {
            $this->avatarPreview = $this->form->avatar->temporaryUrl();
        }
    }

    /**
     * @throws ValidationException
     */
    public function update(): null {

        // Validation
        $attr = $this->form->validate();

        $attr = collect($attr)->except(['userId','password_confirmation','roles','selectStatus','passwordFields'])->toArray();

        // Handle avatar upload
        if ($this->form->avatar) {
            // Delete the old photo if it exists
            if ($this->user->avatar && Storage::disk('public')->exists($this->user->avatar)) {
                Storage::disk('public')->delete($this->user->avatar);
            }

            // Store the new photo
            $path = $this->form->avatar->store('avatars', 'public');
            $attr['avatar'] = $path;
        }else{
            $attr = collect($attr)->except('avatar')->toArray();
        }

        // Handle password
        if (!empty($this->form->password))
        {
            $attr['password'] = Hash::make($this->form->password);
        }else{
            $attr = collect($attr)->except('password')->toArray();
        }

        // Update the user
        $this->user->update($attr);
        $this->user->syncRoles($this->role);

        // Sync selected houses
        $this->user->houses()->sync($this->form->houses);

        // Session flash message
        session()->flash('message', 'User updated successfully!');

        // Redirect user
        return $this->redirectRoute('user.index', navigate: true);
    }


    public function render(): Factory|View|Application
    {
        return view('livewire.user.edit', ['roles' => Role::all()])->title('Update User');
    }
}
