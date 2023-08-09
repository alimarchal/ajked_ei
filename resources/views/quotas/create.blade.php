<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Apply New Quota') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-3 lg:p-4 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('quota.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-4 mb-4">
                            <x-label for="challan_id" value="{{ __('Please select your challan.') }}" />
                            <select name="challan_id" id="challan_id" required class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" >
                                @php
                                    $challan_type_ids = \App\Models\ChallanType::where('type','Quota')->pluck('id');
                                    $challans = \App\Models\Challan::whereIn('challan_type_id',$challan_type_ids)->where('user_id',$user->id)->where('status','Unpaid')->whereNull('challan_receipt_path')->get();
                                @endphp

                                @if($challans->isEmpty())
                                    <option value="">Please generate challan first.</option>
                                @else
                                    @foreach($challans as $ch)
                                        <option value="{{$ch->id}}">Challan No: {{ $ch->id }},  {{$ch->challan_type->name}} - Rs.{{ $ch->amount }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>

                        <livewire:phase-dropdowns/>

                        <div class="mt-4">
                            <x-label for="quantity" value="{{ __('Quota Quantity') }}" />
                            <x-input id="quantity" max="200" class="block mt-1 w-full" type="number" name="quantity" min="0" required :value="old('quantity')" required autofocus autocomplete="quantity" />
                        </div>

                        <div class="mt-4">
                            <x-label for="challan_receipt_paths" value="{{ __('Challan Scanned Proof PDF/JPG/FILE ') }}" />
                            <x-input id="challan_receipt_paths" class="block mt-1 w-full" type="file" name="challan_receipt_paths" accept=".jpeg, .jpg, .png, .pdf" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Submit for Quota') }}
                            </x-button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>

    @push('modals')

        <script>
            function validateForm() {
                const fileInput = document.getElementById('challan_receipt_path');
                const file = fileInput.files[0];

                // Check if a file is selected
                if (!file) {
                    alert('Please select a file.');
                    return false;
                }

                // Check the file size (max 5 MB)
                const maxSize = 5 * 1024 * 1024; // 5 MB in bytes
                if (file.size > maxSize) {
                    alert('File size exceeds the limit of 5 MB.');
                    return false;
                }

                return true; // Allow form submission
            }
        </script>
    @endpush
</x-app-layout>
