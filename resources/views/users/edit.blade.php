<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus autocomplete="name"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required autocomplete="username" />
                        </div>


                        <div class="mt-4">
                            <x-label for="cnic" value="{{ __('CNIC') }}" />
                            <x-input id="cnic" class="block mt-1 w-full" type="text" name="cnic" :value="$user->cnic" required autofocus autocomplete="cnic"/>
                        </div>


                        <div class="mt-4">
                            <x-label for="mobile_no" value="{{ __('Mobile No') }}" />
                            <x-input id="mobile_no" class="block mt-1 w-full" type="text" name="mobile_no" :value="$user->mobile_no" required autofocus autocomplete="mobile_no"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="status" value="{{ __('User Status') }}" />
                            <select name="status" required id="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="1" @if($user->status == 1) selected @endif>Activated</option>
                                <option value="0" @if($user->status == 0) selected @endif>Deactivate</option>
                            </select>
                        </div>



                        <div class="mt-4">
                            <label for="permissions" class="block text-gray-700 text-sm font-bold mb-2">Permissions:</label>
                            @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                                <div class="flex items-center">
                                    <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}" class="form-checkbox"
                                        {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}>
                                    <label for="permission_{{ $permission->id }}" class="ml-2">{{ $permission->name }}</label>
                                </div>
                            @endforeach

                            @error('permissions')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
