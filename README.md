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
## Explanation for the above code

### Livewire Component's blade file `edit-profile.blade.php` 

`wire:model="username"` This attribute tells Livewire to bind the input field to the username property of the component. This means that whenever the user types something in the input field, the username property will be updated with the new value.


`@class([...])` This is a Blade directive that adds classes to the input field based on certain conditions. The classes are defined in an array.

` $errors->missing('username') ? 'border border-gray-300'.  : '' `
This condition checks if there's an error for the username field. If there is, it adds a border to the input field. The border is gray in color.

`errors->has('username') ? 'border-2 border-red-500' : '': `
This condition checks if there's an error for the username field. If there is, it adds a red border to the input field. The border is thicker than the default border.


### Livewire Component file `EditProfile.php`

`EditProfile` class extends class `Component` class provided by livewire.
It declares three public properties that are: 

 `$username`
 `$bio`
 `$showSuccessIndicator`

 `rules()` defines validation rules. ie required..

 `save()` is responsible for saving user input to the database.
 It then creates `profile` record in the database with the provided `username` and `bio`.
Then the method pauses for one second using `sleep(1)`
It sets `showSuccessIndicator` property to `true` to indicate successful save.
Finally, it returns view for the `EditProfile` component.

`render()` returns livewire blade component.


### Adding radio buttons in livewire 

```html
<fieldset class="flex flex-col gap-2">
    <div>
        <legend class="font-medium text-gray-700 text-base">Receive Emails</legend>
    </div>
    <div class="flex gap-6">
        <label class="flex items-center gap-2">
            <input type="radio" name="recieve_emails" class="text-emerald-500 focus:ring-emerald-500">
            Yes
        </label>
        <label class="flex items-center gap-2">
            <input type="radio" name="recieve_emails" class="text-emerald-500 focus:ring-emerald-500">
            No
        </label>
    </div>
</fieldset>
```
By using the `<fieldset>` and `<label>` tags, you ensure that the radio buttons are properly grouped and labeled, making the form more accessible and easier to understand for users, especially those using `screen readers` or other `assistive technologies`.

To add, some styling in radio buttons such as `class="text-emerald-500 focus:ring-emerald-500"`
, 
 Ensure that taiwindCSS for plugin is installed. You can do this by installing via `npm` ie..

 ```php 
 npm install @tailwindcss/forms
 ```

 Go to `tailwind.config.js` inside it ensure you have the following:

 ```js
 import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
};
 ```
With the above, your styling for the radio buttons works 🎉.


