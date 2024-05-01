<?php

namespace App\Livewire;

use App\Models\Profile;
use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Rule;

class EditProfile extends Component
{
    #[Rule('required', message: 'Yo, add username')]
    public $username = '';

    #[Rule('required', message: 'Yo, add bio')]
    public $bio = '';

    public function save()
    {
        $this->validate();

        Profile::create([
            'username' => $this->username,
            'bio'=>$this->bio
        ]);

        sleep(1);

        return view('livewire.edit-profile');

    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
