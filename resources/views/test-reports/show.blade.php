<x-app-layout>
    @push('custom_headers')
        <style>
            /* Define watermark styles for print */
            @if($testReport->noc_issued != 1)
            @media print {
                /* Add the "Not Verified" text on top of the page */
                body::before {
                    content: "[NOT VALID FOR 3-PHASE NOC UNTIL VERIFIED BY ELECTRIC INSPECTOR]";
                    position: absolute;
                    bottom: 50%;
                    left: 50%;
                    transform: translate(-50%, 50%) rotate(-45deg);
                    font-size: 20px; /* Change the font size as needed */
                    font-weight: bold;
                    color: black; /* Change the text color as needed */
                    white-space: nowrap; /* Prevent the text from wrapping to the next line */
                    padding: 20px; /* Optional: add some padding to the watermark */
                }
            }
            @endif
        </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ __('Test Reports') }}
        </h2>


        <div class="flex justify-center items-center float-right">
            <a href="{{ route('testReport.index') }}" class=" text-center px-4 py-2 text-white bg-red-500 border rounded-lg focus:outline-none hover:bg-green-900 transition-colors duration-200 transform dark:text-black dark:border-red-200 dark:hover:bg-green-900 dark:bg-gray-700 ml-2" title="Back">
                Back
            </a>
            <button onclick="window.print()" class=" text-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2" title="Members List">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
            </button>
        </div>

    </x-slot>


    <div class="py-0">
        <div class="max-w-7xl mx-auto ">
            <div class="bg-white dark:bg-gray-800 overflow-hidden content">


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
                        I / authorized wireman have inspected the connection and charged a fee of Rs. {{ number_format($testReport->wc_test_report_fee,  2) }} from the consumer according to Govt. notification, I hereby certify that all electrical wiring work has been executed in accordance with the
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

                        @if(Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0], 'web')->name == "DEI" || Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0], 'web')->name == "AEI")
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

                                @if($rw->status == "Objection" )
                                    <span class="font-extrabold text-sm">
                                        Details: {{ $rw->remarks }}
                                    </span>
                                @else
                                    <span class="font-extrabold text-sm">
                                     I have conducted a site visit and reviewed the corresponding test report. Based on load, consumer submitted a fee of
                                        Rs.{{ $rw->testReport->challan->amount }} via Challan No: {{ $rw->testReport->challan_id }} ,  Dated: {{ \Carbon\Carbon::parse($rw->testReport->challan->date)->format('d-M-Y') }}. Based on my assessment, I recommend granting a No Objection Certificate (NOC) for this connection.
                                    </span>
                                @endif

                                <div class="text-center font-extrabold  text-sm">
                                    {{ Spatie\Permission\Models\Role::findByName($rw->user->getRoleNames()[0],'web')->name }} Findings: {{ $rw->status }}
                                </div>
                            </div>




                        @else
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
                        @endif



                    </div>
                @endforeach


            </div>
        </div>
    </div>
    @push('modals')
        <script>
            function redirectToLink(url) {
                window.location.href = url;
            }
        </script>
    @endpush
</x-app-layout>
