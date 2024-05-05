<h1 style="color:red;">Livewire Forms</h1>

Let's start by creating two livewire files that is Livewire component and Livewire blade component.

We simply accomplish this by writing the following command in our terminal

```php
php artisan make:livewire edit-profile
```
The above command creates two files `EditProfile` (Livewire Component) and `edit-profile.blade.php`.

EditProfile can be located in this path by default: 
`app/Livewire/EditProfile.php` while edit-profile.blade.php can be found in `resources/views/livewire/edit-profile.blade.php`

Inside `EditProfile.php`, let us modify our code to the following:

```php
<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Profile;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditProfile extends Component
{
    // Initialize properties for username, bio, and success indicator
    public $username = '';

    public $bio = '';

    public $showSuccessIndicator = false;

     // Define validation rules for username and bio
    public function rules()
    {
        return
        [
            'username' => ['required', Rule::unique('profiles')],
            'bio' => ['required', Rule::unique('profiles')]
        ];
    }

    // Save the user's input to the database
    public function save()
    {
        // Validate the input before saving
        $this->validate();

        // Create a new record (profie) in the database
        Profile::create([
            'username' => $this->username,
            'bio'=>$this->bio
        ]);

        // Pause execution for 1 second
        sleep(1);

        // Set the success indicator to true
        $this->showSuccessIndicator = true;

        // Return the view for the component
        return view('livewire.edit-profile');

    }

    // Render the view for the component
    public function render()
    {
        return view('livewire.edit-profile');
    }
}

```
Let us modify edit-profile.blade.php to look like:

```php
<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="flex justify-center items-center mt-8 mb-8">
                <h1>Livewire Form</h1>
            </div>
            <div class="flex justify-center items-center mt-8 mb-8">
                <form wire:submit="save" class="w-1/2 max-w-lg bg-white p-8 rounded-lg shadow-md">
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                        <input wire:model="username"
                        @class([
                            'px-3 py-2 rounded-md w-full' ,
                            $errors->missing('username') ? 'border border-gray-300' : '',
                            $errors->has('username') ? 'border-2 border-red-500' : ''
                        ])
                        >
                        @error('username')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="bio" class="block text-gray-700 text-sm font-bold mb-2">Bio</label>
                        <textarea wire:model="bio" rows="4" class="w-full resize-none border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="Enter your bio"
                        ></textarea>
                        @error('bio')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6 flex flex-col-2">
                        <div class="relative w-full ">
                            <button type="submit" class="h-10 bg-blue-500 focus:border-blue-700 text-white font-bold py-2 px-14 rounded disabled:cursor-not-allowed disabled:opacity-75">Submit</button>
                        </div>
                        <div wire:loading.flex class="flex absolute items-center">
                            <x-ei-spinner-2 class="text-white animate-spin h-10" />
                        </div>
                    </div>
                    <div x-show="$wire.showSuccessIndicator" x-transition.out.opacity.duration.2000ms x-effect="if($wire.showSuccessIndicator) setTimeout(() => $wire.showSuccessIndicator = false, 3000)" class="flex justify-center items-end">
                        <p class="text-emerald-500 pr-2">Profile Updated Successfully</p>
                        <x-iconsax-bro-tick-circle class="text-emerald-500 w-5 h-5 " />
                    </div>
                </form>

                <!-- Success Indicator -->

            </div>
        </div>
    </div>
</div>

```
