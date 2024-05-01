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
                        <input wire:model="username" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="Enter your username">
                        @error('username')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="bio" class="block text-gray-700 text-sm font-bold mb-2">Bio</label>
                        <textarea wire:model="bio" rows="4" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" placeholder="Enter your bio"></textarea>
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
                </form>

                <!-- Success Indicator -->
                <div class="flex justify-end pt-4">
                    
                </div>
            </div>
        </div>
    </div>
</div>
