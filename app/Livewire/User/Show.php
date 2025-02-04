<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\House;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Show extends Component
{
    use WithFileUploads;

    public UserForm $form;
    public string $username;
    public string $created;
    public string $updated;
    public array $roles = [];
    public string $createTimesAgo;
    public string $updateTimesAgo;
    public bool $isShow = false;
    public $editId;
    public string $avatarPreview = 'https://preline.co/assets/img/160x160/img1.jpg'; // For image preview
    public string $fileName = 'Upload Photo'; // For file name
    public $houses;

    public function mount(User $user): void
    {
        $this->form->fill( collect($user->toArray())->except(['avatar','password','password_confirmation'])->toArray() );
        $this->form->fill(['houses' => $user->houses->pluck('id')->toArray()]);
        $this->username = $user->name;
        $this->editId = $user->id;
        $this->created = Carbon::parse($user->created_at)->toFormattedDayDateString();
        $this->updated = Carbon::parse($user->updated_at)->toFormattedDayDateString();
        $this->createTimesAgo = Carbon::parse($user->created_at)->diffForHumans();
        $this->updateTimesAgo = Carbon::parse($user->updated_at)->diffForHumans();
        $this->isShow = true;

        // Get houses
        $this->houses = House::query()->where('status', 'active')->get();

        // Get roles
        $this->roles = $user->roles->pluck('name')->toArray();

        // Set the avatar preview to the existing image
        $this->avatarPreview = $user->avatar ? Storage::url($user->avatar) : $this->avatarPreview;
    }

    public function updatedFormAvatar(): void
    {
        // Preview the uploaded image
        if ($this->form->avatar) {
            $this->avatarPreview = $this->form->avatar->temporaryUrl();
            $this->fileName = $this->form->avatar->getClientOriginalName();
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.user.show', ['roles' => Role::all()])->title('User Details');
    }
}
