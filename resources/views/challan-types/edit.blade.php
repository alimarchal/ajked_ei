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
                    <x-validation-errors class="mb-4"/>
                    <form method="POST" action="{{ route('challanType.update', ['challanType' => $challanType->id]) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="name" value="{{ __('Name') }}"/>
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $challanType->name)" required autofocus autocomplete="name"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="amount" value="{{ __('Amount') }}"/>
                            <x-input id="amount" class="block mt-1 w-full" type="number" step="1" min="0" name="amount" :value="old('amount', $challanType->amount)" required autocomplete="amount"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update Challan Type') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
