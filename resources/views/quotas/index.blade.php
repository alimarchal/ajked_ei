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
            {{ __('Apply New Quota') }}
        </h2>


        <div class="flex justify-center items-center float-right">

            {{--            @can('create')--}}
            <div class="flex justify-center items-center float-right">
                <a href="{{ route('quota.create') }}"
                   class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2">
                    <span class="hidden md:inline-block ml-2">Apply New Quota</span>
                </a>
            </div>
            {{--            @endcan--}}

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
            <form action="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="name">Name</label>
                        <input id="name" type="text" name="filter[name]" value="{{ request('filter.name') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">Email</label>
                        <input id="email" type="text" name="filter[email]" value="{{ request('filter.email') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="mobile_no">Mobile No</label>
                        <input id="mobile_no" type="text" name="filter[mobile_no]" value="{{ request('filter.mobile_no') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="license_number">License Number</label>
                        <input id="license_number" type="text" name="filter[license_number]" value="{{ request('filter.license_number') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="cnic">CNIC</label>
                        <input id="cnic" type="text" name="filter[cnic]" value="{{ request('filter.cnic') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    {{--                    <div>--}}
                    {{--                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="date_range">CNIC</label>--}}
                    {{--                        <input readonly name="filter[starts_before]" id="date_range" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">--}}
                    {{--                    </div>--}}
                    <div>
                    </div>


                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl ">
                <div class=" bg-white overflow-x-auto dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->


                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>
                            <th scope="col" class="px-1 py-3 border border-black ">
                                ID
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Applied By
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Type
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                <abbr title="Quantity">QTY</abbr>
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                <abbr title="Outstanding Balance">OB</abbr>
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Challan
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Approved By
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Remarks
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Status
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Applied Date
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($quotas as $quota)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-2 py-2  border-black font-medium  text-centertext-black dark:text-white">
                                    {{ $quota->id }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    @if(!empty($quota->user))
                                        {{ $quota->user->name }}
                                    @endif
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $quota->type }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $quota->quantity }}
                                </td>


                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $quota->outstanding_balance }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    @if(!empty($quota->challan))
                                        <a href="{{ Storage::url($quota->challan->challan_receipt_path) }}" class="text-blue-500 hover:underline" target="_blank">View</a>
                                    @else
                                        @if(auth()->user()->hasRole('Wiring Contractor'))
                                            <a href="{{ route('quota.create') }}" class="text-blue-500 hover:underline">Upload</a>
                                        @else
                                            Not Uploaded
                                        @endif
                                    @endif

                                </td>
                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    @if(!empty($quota->approved_by))
                                        {{ \App\Models\User::find($quota->approved_by)->name }}
                                    @endif
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $quota->remarks }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $quota->status }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ \Carbon\Carbon::parse($quota->created_at)->format('d-m-Y') }}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

    @push('modals')
        <script>
            $(document).ready(function () {

                $("#date_range").daterangepicker({
                    minDate: moment().subtract(10, 'years'),
                    orientation: 'left',
                    callback: function (startDate, endDate, period) {
                        $(this).val(startDate.format('L') + ' – ' + endDate.format('L'));
                    }
                });
            });

            const targetDiv = document.getElementById("filters");
            const btn = document.getElementById("toggle");
            btn.onclick = function () {
                if (targetDiv.style.display !== "none") {
                    targetDiv.style.display = "none";
                } else {
                    targetDiv.style.display = "block";
                }
            };
        </script>
    @endpush
</x-app-layout>
