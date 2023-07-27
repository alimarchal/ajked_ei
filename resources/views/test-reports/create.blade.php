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
                    <x-validation-errors class="mb-4"/>
                    <form method="POST" action="{{ route('testReport.store') }}">
                        @csrf

                        <livewire:phase-dropdowns />


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">


                            <div>
                                <x-label for="division_sub_division_id" value="{{ __('Sub-Division') }}"/>
                                <select name="division_sub_division_id" required id="division_sub_division_id"
                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">None</option>
                                    @foreach(\App\Models\DivisionSubDivision::orderBy('division_code','ASC')->get() as $div_suv_div)
                                        <option value="{{ $div_suv_div->id }}">{{ $div_suv_div->sub_division_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div>
                                <x-label for="transformer_capacity" value="{{ __('Transformer Capacity') }}"/>
                                <x-input id="transformer_capacity" class="block mt-1 w-full" type="text" name="transformer_capacity" :value="old('transformer_capacity')" required autofocus/>
                            </div>


                            <div>
                                <x-label for="consumer_name" value="{{ __('Consumer Name') }}"/>
                                <x-input id="consumer_name" class="block mt-1 w-full" type="text" name="consumer_name" :value="old('consumer_name')" required/>
                            </div>

                            <div>
                                <x-label for="father_husband_name" value="{{ __('Father/Husband Name') }}"/>
                                <x-input id="father_husband_name" class="block mt-1 w-full" type="text" name="father_husband_name" :value="old('father_husband_name')" required/>
                            </div>


                            <div>
                                <x-label for="cnic" value="{{ __('CNIC') }}" />
                                <x-input id="cnic" class="block mt-1 w-full" type="text" name="cnic" :value="old('cnic')" required />
                            </div>

                            <div>
                                <x-label for="mobile_number" value="{{ __('Mobile Number') }}"/>
                                <x-input id="mobile_number" class="block mt-1 w-full" type="text" name="mobile_number" :value="old('mobile_number')" required/>
                            </div>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">

                            <div class="mt-4">
                                <x-label for="complete_address" value="{{ __('Complete Address') }}"/>
                                <textarea name="complete_address" id="complete_address" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 text-center">
                            <h1 class="text-2xl mt-4 font-extrabold">LOAD DETAIL</h1>
                            <hr>
                        </div>

                        <livewire:load-details-form />


                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 text-center">
                            <h1 class="text-2xl mt-4 font-extrabold">TEST RESULTS</h1>
                            <hr>
                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">

                            <div>
                                <x-label for="insulation" value="{{ __('Insulation') }}"/>
                                <x-input id="insulation" class="block mt-1 w-full" type="text" name="insulation" :value="old('insulation')" required autofocus/>
                            </div>

                            <div>
                                <x-label for="continuity" value="{{ __('Continuity') }}"/>
                                <x-input id="continuity" class="block mt-1 w-full" type="text" name="continuity" :value="old('continuity')" required/>
                            </div>

                            <div>
                                <x-label for="earthing" value="{{ __('Earthing') }}"/>
                                <x-input id="earthing" class="block mt-1 w-full" type="text" name="earthing" :value="old('earthing')" required/>
                            </div>
                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">


                            <label>
                                <div class="mt-6 text-justify">
                                    <x-input type="checkbox" name="agreement"/>
                                    I / authorized wireman have inspected the connection and charged a fee of Rs. (Please type in input box)
                                    from the consumer according to Govt. notification, I hereby certify that all electrical wiring work has been executed in accordance with the Electricity Rules, 1937.
                                </div>

                                <div>
                                    <x-input id="wc_test_report_fee" required placeholder="Type fee here..." class="block mt-1 w-full" type="number" step="0.01" min="0" name="wc_test_report_fee" :value="old('wc_test_report_fee')" required/>
                                </div>

                            </label>


                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4" id="submit-btn" onclick="return confirm('Are you sure you want to generate challan?')">
                                {{ __('Submit & Print') }}
                            </x-button>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>


    @push('modals')
        <script>
            // Add a script to format the CNIC input as 00000-0000000-0
            document.getElementById('cnic').addEventListener('input', function (e) {
                const cnicInput = e.target;
                let cnic = cnicInput.value.replace(/[^0-9]/g, '');

                if (cnic.length > 13) {
                    cnic = cnic.slice(0, 13);
                }

                const parts = cnic.match(/(\d{5})(\d{7})(\d{1})?/);

                if (parts) {
                    let formattedCnic = parts[1] + '-' + parts[2];

                    if (parts[3]) {
                        formattedCnic += '-' + parts[3];
                    }

                    cnicInput.value = formattedCnic;
                } else {
                    cnicInput.value = cnic;
                }
            });

            // // Disable the submit button after it's clicked
            // document.getElementById('submit-btn').addEventListener('click', function (e) {
            //     // Disable the button to prevent multiple submissions
            //     this.disabled = true;
            // });
        </script>
    @endpush
</x-app-layout>
