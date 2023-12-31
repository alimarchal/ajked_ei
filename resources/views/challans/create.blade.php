<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generate Challan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('challan.store') }}">
                        @csrf

                        <div>
                            <x-label for="name" value="{{ __('Challan For') }}" />
                            <select name="challan_type_id" autofocus required id="challan_type_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">None</option>

                                @role('DEI|AEI')
                                    @foreach(\App\Models\ChallanType::where('name','Challan For No Objection Certificate (NOC)')->get() as $ct)
                                        <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                    @endforeach
                                @endrole

                                @role('Wiring Contractor')
                                @foreach(\App\Models\ChallanType::whereIn('type',['Inspection','Test Report','License','Quota'])->get() as $ct)
                                    <option value="{{ $ct->id }}">{{ $ct->name }} - Rs.{{ number_format($ct->amount,0) }}</option>
                                @endforeach
                                @endrole
                            </select>
                        </div>

                        @role('DEI|AEI')
                        <div class="mt-4">
                            <x-label for="test_report_id" value="{{ __('Test Report No') }}" />
                            <input type="text" id="test_report_id" name="test_report_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                        </div>

                        <div class="mt-4">
                            <x-label for="amount" value="{{ __('Amount') }}" />
                            <input type="number" min="0" id="amount" name="amount" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                        </div>
                        @endrole

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4" onclick="return confirm('Are you sure you want to generate challan?')">
                                {{ __('Generate Challan') }}
                            </x-button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
