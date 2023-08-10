<x-app-layout>
    @push('custom_headers')
        <link rel="stylesheet" href="https://cms.ajkced.gok.pk/daterange/daterangepicker.min.css">
        <script src="https://cms.ajkced.gok.pk/daterange/jquery-3.6.0.min.js"></script>
        <script src="https://cms.ajkced.gok.pk/daterange/moment.min.js"></script>
        <script src="https://cms.ajkced.gok.pk/daterange/knockout-3.5.1.js" defer></script>
        <script src="https://cms.ajkced.gok.pk/daterange/daterangepicker.min.js" defer></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ __('Test Reports') }}
        </h2>

        <div class="flex justify-center items-center float-right">

            <a href="{{ route('testReport.create') }}"
               class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2">
                Issue New Test Report
            </a>

            <a href="javascript:;" id="toggle"
               class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"
               title="Members List">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <span class="hidden md:inline-block ml-2" style="font-size: 14px;">Search Filters</span>
            </a>

        </div>

    </x-slot>
    <div class="max-w-7xl mx-auto mt-12 px-4 sm:px-6 lg:px-8 print:hidden" style="display: none" id="filters">
        <div class="rounded-xl p-4 bg-white shadow-lg">
            <form action="{{ route('testReport.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                               for="name">Name</label>
                        <input id="name" type="text" name="filter[consumer_name]"
                               value="{{ request('filter.consumer_name') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                               for="father_husband_name">Father/Husband Name</label>
                        <input id="father_husband_name" type="text" name="filter[father_husband_name]"
                               value="{{ request('filter.father_husband_name') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="mobile_no">Mobile
                            No</label>
                        <input id="mobile_no" type="text" name="filter[mobile_number]"
                               value="{{ request('filter.mobile_number') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                               for="cnic">CNIC</label>
                        <input id="cnic" type="text" name="filter[cnic]" value="{{ request('filter.cnic') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="phase_id">Connection Type</label>
                        <select name="filter[phase_id]" id="selectedPhase"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Select a phase</option>
                            <option value="1" {{ request('filter.phase_id') == 1 ? 'selected' : '' }}>Single Phase
                                Connection
                            </option>
                            <option value="2" {{ request('filter.phase_id') == 2 ? 'selected' : '' }}>3 Phase
                                Connection
                            </option>
                        </select>
                    </div>



                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="phase_id">Status</label>
                        <select name="filter[status]" id="selectedPhase"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">Select a status</option>
                            <option value="Approved" {{ request('filter.status') == 'Approved' ? 'selected' : '' }}>
                                Approved
                            </option>
                            <option value="Objection" {{ request('filter.status') == 'Objection' ? 'selected' : '' }}>
                                Objection
                            </option>

                            <option value="In-Process" {{ request('filter.status') == 'In-Process' ? 'selected' : '' }}>
                                In-Process
                            </option>
                        </select>
                    </div>

                    <div></div>
                    <div></div>
                    <div></div>

                    <!-- Add any additional filter fields here if needed -->

                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                            Search
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden ">
                <div class=" bg-white overflow-x-auto dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->


                    @role('Wiring Contractor')
                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                RID
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Date
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Consumer Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                CNIC No
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Type
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDIV
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Status
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center print:hidden">
                                Print
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($test_reports as $test_report)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $test_report->id }}
                                </th>

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ \Carbon\Carbon::parse($test_report->created_at)->format('d-M-Y') }}
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $test_report->consumer_name }}
                                </th>

                                <th class="border px-2 py-2 border-black text-center font-medium text-black dark:text-white">
                                    {{ $test_report->cnic }}
                                </th>

                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    {{ $test_report->phase->name }}
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    {{ $test_report->divisionSubDivision->sub_division_name }}
                                </th>


{{--                                @if($test_report->phase_id == 1)--}}
{{--                                    <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white bg-green-300">--}}
{{--                                        {{ $test_report->status }}--}}
{{--                                    </th>--}}
{{--                                @else--}}
                                    <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white @if($test_report->status == "In-Process") bg-yellow-50 @elseif($test_report->status == "Objection") bg-red-400 @else bg-green-300 @endif ">
                                        {{ $test_report->status }}
                                    </th>
{{--                                @endif--}}

                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white print:hidden">
                                    <button onclick="redirectToLink('{{ route('testReport.show', $test_report->id) }}')"
                                            class=" text-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2"
                                            title="Members List">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </button>
                                </th>

                        @endforeach

                        </tbody>
                    </table>
                    @endrole


                    @role('SDO|X-En')
                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                RID
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Date
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Consumer Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                CNIC No
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Type
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDIV
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDO/X-EN
                            </th>

                            {{--                            <th scope="col" class="px-1 py-3 border border-black  text-center">--}}
                            {{--                                DEI/AEI--}}
                            {{--                            </th>--}}

                            {{--                            <th scope="col" class="px-1 py-3 border border-black  text-center">--}}
                            {{--                                EI--}}
                            {{--                            </th>--}}


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Status
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center print:hidden">
                                Print
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($test_reports as $test_report)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $test_report->id }}
                                </th>

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ \Carbon\Carbon::parse($test_report->created_at)->format('d-M-Y') }}
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $test_report->consumer_name }}
                                </th>

                                <th class="border px-2 py-2 border-black text-center font-medium text-black dark:text-white">
                                    {{ $test_report->cnic }}
                                </th>

                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->phase->name == "3 Phase Connection")
                                        3-Phase
                                    @else
                                        Singe-Phase
                                    @endif
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    {{ $test_report->divisionSubDivision->sub_division_name }}
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">


                                    @if($test_report->sdo_verified == 0 || $test_report->xen_verified == 0)

                                        @if($test_report->phase_id == 2 )
                                            <a href="{{ route('testReport.review.create',  $test_report->id) }}"
                                               class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                Validate
                                            </a>
                                        @else
                                            Seen
                                        @endif


                                    @else
                                        {{ $test_report->sdo_xen_status }}

                                    @endif
                                </th>

                                {{--                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">--}}
                                {{--                                    ✔--}}
                                {{--                                </th>--}}


                                {{--                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">--}}
                                {{--                                    ✘--}}
                                {{--                                </th>--}}


                                    <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white @if($test_report->status == "In-Process") bg-yellow-50 @elseif($test_report->status == "Objection") bg-red-400 @else bg-green-300 @endif ">
                                        {{ $test_report->status }}
                                    </th>

                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white print:hidden">
                                    <button onclick="redirectToLink('{{ route('testReport.show', $test_report->id) }}')"
                                            class=" text-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2"
                                            title="Members List">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </button>
                                </th>

                        @endforeach

                        </tbody>
                    </table>
                    @endrole


                    @role('DEI|AEI')
                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                RID
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Date
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Consumer Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                CNIC No
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Type
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDIV
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDO/X-EN
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                DEI/AEI
                            </th>

                            {{--                            <th scope="col" class="px-1 py-3 border border-black  text-center">--}}
                            {{--                                EI--}}
                            {{--                            </th>--}}


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Status
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center print:hidden">
                                Print
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($test_reports as $test_report)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $test_report->id }}
                                </th>

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ \Carbon\Carbon::parse($test_report->created_at)->format('d-M-Y') }}
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $test_report->consumer_name }}
                                </th>

                                <th class="border px-2 py-2 border-black text-center font-medium text-black dark:text-white">
                                    {{ $test_report->cnic }}
                                </th>

                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->phase->name == "3 Phase Connection")
                                        3-Phase
                                    @else
                                        Singe-Phase
                                    @endif
                                </th>

                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    {{ $test_report->divisionSubDivision->sub_division_name }}
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->sdo_verified == 0 || $test_report->xen_verified == 0)

                                        @if($test_report->phase_id == 2 )
                                            Pending
                                        @else
                                            Seen
                                        @endif

                                    @else
                                    {{ $test_report->sdo_xen_status }}
                                    @endif
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">

                                    @if($test_report->dei_verified == 0 || $test_report->aei_verified == 0)
                                        @if($test_report->phase_id == 2 )
                                            <a href="{{ route('testReport.review.create',  $test_report->id) }}"
                                               class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                Validate
                                            </a>
                                        @else
                                            Seen
                                        @endif

                                    @else
                                        {{ $test_report->dei_aei_status }}
                                    @endif


                                </th>

                                {{--                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">--}}
                                {{--                                    ✔--}}
                                {{--                                </th>--}}


                                {{--                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">--}}
                                {{--                                    ✘--}}
                                {{--                                </th>--}}


                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white @if($test_report->status == "In-Process") bg-yellow-50 @elseif($test_report->status == "Objection") bg-red-400 @else bg-green-300 @endif ">
                                        {{ $test_report->status }}
                                    </th>

                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white print:hidden">
                                    <button onclick="redirectToLink('{{ route('testReport.show', $test_report->id) }}')"
                                            class=" text-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2"
                                            title="Members List">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </button>
                                </th>

                        @endforeach

                        </tbody>
                    </table>
                    @endrole

                    @role('Electric Inspector')
                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                RID
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Date
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Consumer Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                CNIC No
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Type
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDIV
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDO/X-EN
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                DEI/AEI
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                EI
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Status
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center print:hidden">
                                Print
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($test_reports as $test_report)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $test_report->id }}
                                </th>

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ \Carbon\Carbon::parse($test_report->created_at)->format('d-M-Y') }}
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $test_report->consumer_name }}
                                </th>

                                <th class="border px-2 py-2 border-black text-center font-medium text-black dark:text-white">
                                    {{ $test_report->cnic }}
                                </th>

                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->phase->name == "3 Phase Connection")
                                        3-Phase
                                    @else
                                        Singe-Phase
                                    @endif
                                </th>

                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    {{ $test_report->divisionSubDivision->sub_division_name }}
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->sdo_verified == 0 || $test_report->xen_verified == 0)

                                        @if($test_report->phase_id == 2 )
                                            Pending
                                        @else
                                            Seen
                                        @endif


                                    @else
                                        {{ $test_report->sdo_xen_status }}
                                    @endif
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->dei_verified == 0 || $test_report->aei_verified == 0)

                                        @if($test_report->phase_id == 2 )
                                            Pending
                                        @else
                                            Seen
                                        @endif
                                    @else
                                        {{ $test_report->dei_aei_status }}
                                    @endif
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->sdo_xen_status == "Approved" && $test_report->dei_aei_status == "Approved" && $test_report->ei_verified == 0)
                                        <a href="{{ route('testReport.review.create',  $test_report->id) }}"
                                           class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            ISSUE NOC
                                        </a>
                                    @elseif( $test_report->ei_verified == 1 &&  $test_report->noc_issued == 1)
                                        @if($test_report->status == "Objection")
                                            Objection
                                        @else
                                            NOC Issued
                                        @endif

                                    @else

                                        @if($test_report->phase_id == 2 )
                                            @if(($test_report->sdo_xen_status == "Approved" || $test_report->sdo_xen_status == "Objection") && ($test_report->dei_aei_status == "Approved" || $test_report->dei_aei_status == "Objection") && $test_report->ei_verified == 0)
                                                <a href="{{ route('testReport.review.create',  $test_report->id) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                    Give Decision
                                                </a>

                                            @else

                                                Waiting...
                                            @endif


                                        @else
                                            Seen
                                        @endif

                                    @endif
                                </th>



                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white @if($test_report->status == "In-Process") bg-yellow-50 @elseif($test_report->status == "Objection") bg-red-400 @else bg-green-300 @endif ">
                                        {{ $test_report->status }}
                                    </th>

                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white print:hidden">
                                    <button onclick="redirectToLink('{{ route('testReport.show', $test_report->id) }}')"
                                            class=" text-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2"
                                            title="Members List">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </button>
                                </th>

                        @endforeach

                        </tbody>
                    </table>
                    @endrole

                    @role('Super-Admin')
                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                RID
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Date
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Consumer Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                CNIC No
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Type
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDIV
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                SDO/X-EN
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                DEI/AEI
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                EI
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Status
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center print:hidden">
                                Print
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($test_reports as $test_report)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $test_report->id }}
                                </th>

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ \Carbon\Carbon::parse($test_report->created_at)->format('d-M-Y') }}
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $test_report->consumer_name }}
                                </th>

                                <th class="border px-2 py-2 border-black text-center font-medium text-black dark:text-white">
                                    {{ $test_report->cnic }}
                                </th>

                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->phase->name == "3 Phase Connection")
                                        3-Phase
                                    @else
                                        Singe-Phase
                                    @endif
                                </th>

                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    {{ $test_report->divisionSubDivision->sub_division_name }}
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->sdo_verified == 0 || $test_report->xen_verified == 0)

                                        @if($test_report->phase_id == 2 )
                                            Pending
                                        @else
                                            Seen
                                        @endif


                                    @else
                                        {{ $test_report->sdo_xen_status }}
                                    @endif
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->dei_verified == 0 || $test_report->aei_verified == 0)

                                        @if($test_report->phase_id == 2 )
                                            Pending
                                        @else
                                            Seen
                                        @endif
                                    @else
                                        {{ $test_report->dei_aei_status }}
                                    @endif
                                </th>


                                <th class="border px-2 py-2 border-black  text-centerfont-medium text-center text-black dark:text-white">
                                    @if($test_report->sdo_xen_status == "Approved" && $test_report->dei_aei_status == "Approved" && $test_report->ei_verified == 0)
                                        Pending
                                    @elseif( $test_report->ei_verified == 1 &&  $test_report->noc_issued == 1)
                                        @if($test_report->status == "Objection")
                                            Objection
                                        @else
                                            NOC Issued
                                        @endif

                                    @else

                                        @if($test_report->phase_id == 2 )
                                            @if(($test_report->sdo_xen_status == "Approved" || $test_report->sdo_xen_status == "Objection") && ($test_report->dei_aei_status == "Approved" || $test_report->dei_aei_status == "Objection") && $test_report->ei_verified == 0)
                                                Pending

                                            @else

                                                Waiting...
                                            @endif


                                        @else
                                            Seen
                                        @endif

                                    @endif
                                </th>



                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white @if($test_report->status == "In-Process") bg-yellow-50 @elseif($test_report->status == "Objection") bg-red-400 @else bg-green-300 @endif ">
                                    {{ $test_report->status }}
                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white print:hidden">
                                    <button onclick="redirectToLink('{{ route('testReport.show', $test_report->id) }}')"
                                            class=" text-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2"
                                            title="Members List">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </button>
                                </th>

                        @endforeach

                        </tbody>
                    </table>
                    @endrole
                </div>
            </div>
        </div>
    </div>
    @push('modals')
        <script>

            const targetDiv = document.getElementById("filters");
            const btn = document.getElementById("toggle");
            btn.onclick = function () {
                if (targetDiv.style.display !== "none") {
                    targetDiv.style.display = "none";
                } else {
                    targetDiv.style.display = "block";
                }
            };

            function redirectToLink(url) {
                window.location.href = url;
            }
        </script>
    @endpush
</x-app-layout>
