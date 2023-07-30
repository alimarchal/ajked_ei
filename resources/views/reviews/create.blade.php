<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submit Test Report Review By') }} {{ optional($user->roles->first())->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->


                    <div class="grid grid-cols-3 gap-4">
                        <div></div> <!-- Empty column for spacing -->
                        <div class="flex items-center justify-center">
                            <img src="{{ Storage::url('logo.png') }}" alt="Logo" class="h-16 mx-auto">
                        </div>
                        <div class="text-right mx-auto">
                            @php $test_report_data = "http://127.0.0.1:8000/testReport/" . $testReport->id; @endphp
                            {!! DNS2D::getBarcodeSVG($test_report_data, 'QRCODE',3,3) !!}
                        </div>
                    </div>

                    {{--                <img src="{{ Storage::url('logo.png') }}" alt="Logo Government" class="h-16 mx-auto">--}}
                    <h3 class="text-lg text-center font-extrabold">
                        Government of Azad Jammu & Kashmir
                    </h3>
                    <h1 class="text-lg text-center font-extrabold">Inspectorate of Electricity</h1>
                    <h2 class="text-lg text-center font-extrabold">{{ ucwords(strtolower('WIRING TEST REPORT')) }} ({{ $testReport->phase->name }}) - {{ $testReport->phase_type->type }}</h2>


                    <table class="w-full text-sm mt-2 border-collapse border border-slate-400 text-left text-black dark:text-gray-400">

                        <tbody style="font-size: 12px;">
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Test Report ID
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                {{ $testReport->id }}
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Date of Issue
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                {{ \Carbon\Carbon::parse($testReport->date)->format('d-M-Y') }}
                            </td>
                        </tr>

                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Sub-Division
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $testReport->divisionSubDivision->sub_division_name }}
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Transformer Capacity
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $testReport->transformer_capacity }}
                            </td>
                        </tr>

                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Consumer Name
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $testReport->consumer_name }}
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Father Name
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $testReport->father_husband_name }}
                            </td>
                        </tr>

                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                CNIC No.
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $testReport->cnic }}
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Mobile Number
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $testReport->mobile_number }}
                            </td>
                        </tr>


                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Address:
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" colspan="3">
                                {{ $testReport->complete_address }}
                            </td>
                        </tr>

                        </tbody>
                    </table>


                    <h2 class="text-lg font-extrabold mt-1.5 mb-1.5 text-center">Load Detail</h2>
                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black bg-gray-50 dark:bg-gray-700" style="font-size: 12px;">
                        <tr>

                            <th class="px-1 py-0.5 border border-black text-left">
                                ID
                            </th>

                            <th class="px-1 py-0.5 border border-black text-left">
                                Type
                            </th>

                            <th class="px-1 py-0.5 border border-black  text-left">
                                Watts
                            </th>

                            <th class="px-1 py-0.5 border border-black  text-left">
                                Nos
                            </th>

                            <th class="px-1 py-0.5 border border-black  text-left">
                                Total
                            </th>

                            <th class="px-1 py-0.5 border border-black  text-left">
                                Cable Size
                            </th>

                        </tr>
                        </thead>
                        <tbody style="font-size: 12px;">
                        @foreach($testReport->loadDetails as $ld)

                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $ld->type }}
                                </td>

                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $ld->watts }}
                                </td>


                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $ld->nos }}
                                </td>


                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $ld->total }}
                                </td>

                                <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                    {{ $ld->cable_sizes }}
                                </td>


                            </tr>


                        @endforeach

                    </table>


                    <h2 class="text-lg font-extrabold mt-1.5 mb-1.5 text-center">Test Results</h2>

                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black bg-gray-50 dark:bg-gray-700" style="font-size: 12px;">
                        <tr>

                            <th class="px-1 py-0.5 border border-black text-left">
                                ID
                            </th>

                            <th class="px-1 py-0.5 border border-black text-left">
                                Insulation
                            </th>

                            <th class="px-1 py-0.5 border border-black  text-left">
                                Continuity
                            </th>

                            <th class="px-1 py-0.5 border border-black  text-left">
                                Earthing
                            </th>


                        </tr>
                        </thead>
                        <tbody style="font-size: 12px;">
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                1
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $testReport->insulation }}
                            </td>

                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $testReport->continuity }}
                            </td>


                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $testReport->earthing }}
                            </td>


                        </tr>
                    </table>


                    <div class="grid grid-cols-1 gap-4">
                        <div class="mt-4 text-justify p-2" style="border: 1px solid black;font-size: 12px;">
                            I / authorized wireman have inspected the connection and charged a fee of Rs. {{ number_format($testReport->wc_test_report_fee,  2) }} from the consumer according to Govt. notification, I hereby certify that all electrical wiring work has been executed in accordance with
                            the
                            Electricity Rules, 1937.
                            <br>
                            <hr class="border-black" style="margin-top: 2px; margin-bottom: 2px;">

                            <span class="font-extrabold">
                            W/C Name: {{ $testReport->user->name }} /
                            D-{{ $testReport->divisionSubDivision->division_name}} /
                            SD-{{ $testReport->divisionSubDivision->sub_division_name}}
                        </span>
                            <br>
                            <span class="font-extrabold">
                            WCID: {{ $testReport->user->id }}-Created-{{ $testReport->created_at }}  /
                            License No: {{ $testReport->user->license_number }}
                        </span>
                            <br>
                            <span class="font-extrabold">
                            This document is computer-generated test report & does not require any signatures or stamp. Verification can be done by scanning the provided QR Code. This report will be considered valid after authorizing by Sub Divisional Officer.
                        </span><br>

                        </div>
                    </div>


                    @foreach($testReport->reviews as $rw)
                        <div class="grid grid-cols-1 gap-4">
                            <div class="mt-2 text-justify p-2" style="border: 1px solid black;font-size: 12px;">
                        <span class="font-extrabold text-sm">
                            Test Report Verified By {{ $rw->user->name }}  ---
                            Designation:  {{ Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0],'web')->name }} ---
                            Sub Division: {{ $rw->divisionSubDivision->sub_division_name }}
                        </span>
                                <br>
                                <span class="font-extrabold text-sm">
                            UID: {{ $rw->user->id }}-Created-{{ $rw->created_at }}
                        </span>
                                <br>
                                <span class="font-extrabold text-sm">
                                Description: {{ $rw->remarks }}
                        </span>
                                <div class="text-center font-extrabold  text-sm">
                                    {{ Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0],'web')->name }} Findings: {{ $rw->status }}
                                </div>
                            </div>


                        </div>
                    @endforeach


                    <x-validation-errors class="mb-4"/>

                    @role('SDO|X-En|DEI|AEI|Electric Inspector')

                    @role('SDO|X-En')

                    @if($testReport->sdo_verified == 0 || $testReport->xen_verified == 0)

                        <form method="POST" action="{{ route('review.store') }}">
                            @csrf

                            <input type="hidden" name="test_report_id" value="{{ $testReport->id }}">
                            <div class="mt-4">
                                <x-label for="remarks" value="{{ __('Please select Approve / Objection') }}"/>
                                <select name="remarks" id="remarks" required class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select Approve / Objection.</option>
                                    <option value="1">Approve</option>
                                    <option value="0">Objection</option>

                                </select>
                            </div>

                            <div class="mt-4">
                                <x-label for="details" value="{{ __('Details') }}"/>
                                <textarea name="details" id="details"
                                          class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            </div>

                            <div class="flex items-center justify-end mt-4">

                                <x-button class="ml-4">
                                    {{ __('Submit') }}
                                </x-button>
                            </div>
                        </form>
                    @endif

                    @endrole




                    @role('DEI|AEI')

                    @if($testReport->dei_verified == 0 || $testReport->aei_verified == 0)

                        <form method="POST" action="{{ route('review.store') }}">
                            @csrf

                            <input type="hidden" name="test_report_id" value="{{ $testReport->id }}">
                            <div class="mt-4">
                                <x-label for="remarks" value="{{ __('Please select Approve / Objection') }}"/>
                                <select name="remarks" id="remarks" required class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select Approve / Objection.</option>
                                    <option value="1">Approve</option>
                                    <option value="0">Objection</option>

                                </select>
                            </div>

                            <div class="mt-4">
                                <x-label for="details" value="{{ __('Details') }}"/>
                                <textarea name="details" id="details"
                                          class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            </div>

                            <div class="flex items-center justify-end mt-4">

                                <x-button class="ml-4">
                                    {{ __('Submit') }}
                                </x-button>
                            </div>
                        </form>
                    @endif

                    @endrole

                    @endrole


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
