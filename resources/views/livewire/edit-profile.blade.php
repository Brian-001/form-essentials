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
                        <input wire:model="username" @class([ 'px-3 py-2 rounded-md w-full focus:border-emerald-700' , $errors->missing('username') ? 'border border-gray-300' : '',
                        $errors->has('username') ? 'border-2 border-red-500' : ''
                        ])
                        >
                        @error('username')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="bio" class="block text-gray-700 text-sm font-bold mb-2">Bio</label>
                        <textarea wire:model="bio" rows="4" class="w-full resize-none border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-emerald-500" placeholder="Enter your bio"></textarea>
                        @error('bio')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <select name="" id="" class="w-full px-3 py-2 rounded-lg focus:border-emerald-700">
                            <option value="foo">Foo</option>
                            <option value="foo">Food</option>
                        </select>
                    </div>

                    <div class="mb-6 flex flex-col-2">
                        <div class="relative w-full ">
                            <button type="submit" class="h-10 bg-emerald-500 focus:border-emerald-700 text-white font-bold py-2 px-14 rounded disabled:cursor-not-allowed disabled:opacity-75">Submit</button>
                        </div>
                        <div wire:loading.flex class="flex absolute items-center">
                            <x-ei-spinner-2 class="text-white animate-spin h-10" />
                        </div>
                    </div>
                    <fieldset class="flex flex-col gap-2 mb-6">
                        <div>
                            <legend class="font-medium text-gray-700 text-base">Receive Emails</legend>
                        </div>
                        <div class="flex gap-6">
                            <label class="flex items-center gap-2">
                                <input wire:model.boolean="receive_emails" type="radio" name="recieve_emails" class="text-emerald-500 focus:ring-emerald-500">
                                Yes
                            </label>
                            <label class="flex items-center gap-2">
                                <input wire:model.boolean="receive_emails" type="radio" name="recieve_emails" class="text-emerald-500 focus:ring-emerald-500">
                                No
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="flex flex-col gap-2">
                        <div>
                            <legend class="font-medium text-gray-700 text-base">Email Types?</legend>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="receive_updates" class="text-emerald-500 focus:ring-emerald-500 rounded">
                                General Updates
                            </label>
                            <label class=" flex items-center gap-2">
                                <input type="checkbox" name="receive_offers" class="text-emerald-500 focus:ring-emerald-500 rounded">
                                Marketing Offers
                            </label>
                        </div>
                    </fieldset>
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
