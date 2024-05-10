<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Profile;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditProfile extends Component
{
    public $username = '';

    public $bio = '';

    public $showSuccessIndicator = false;

    public $receive_emails = false;

    public function rules()
    {
        return
        [
            'username' => ['required', Rule::unique('profiles')],
            'bio' => ['required', Rule::unique('profiles')],
        ];
    }

    public function save()
    {
        $this->validate();

        Profile::create([
            'username' => $this->username,
            'bio'=>$this->bio,
            'receive_emails'=> $this->receive_emails
        ]);

        sleep(1);

        $this->showSuccessIndicator = true;

        return view('livewire.edit-profile');

    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
