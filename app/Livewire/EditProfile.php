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

    public $receive_updates = false;

    public $receive_offers = false;

    public $country = '';

    public function rules()
    {
        return
        [
            'username' => ['required', Rule::unique('profiles')],
            'bio' => ['required', Rule::unique('profiles')],
            'receive_emails' => ['required'],
            'country' => ['required']
        ];
    }

    public function save()
    {
        $this->validate();

        Profile::create([
            'username' => $this->username,
            'bio'=>$this->bio,
            'receive_emails'=> $this->receive_emails,
            'receive_updates'=> $this->receive_updates,
            'receive_offers' => $this->receive_offers,
            'country' => $this->country
        ]);

        sleep(1);

        $this->showSuccessIndicator = true;



    }

    public function render()
    {
        return view('livewire.edit-profile', [
            'showSuccessIndicator' => $this->showSuccessIndicator
        ]);
    }
}
