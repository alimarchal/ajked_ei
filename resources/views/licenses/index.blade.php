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
            All Licenses Details
        </h2>


        <div class="flex justify-center items-center float-right">


            @role('Wiring Contractor')
            <div class="flex justify-center items-center float-right">
                <a href="{{ route('quota.create') }}"
                   class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2">
                    <span class="hidden md:inline-block ml-2">Apply New Quota</span>
                </a>
            </div>
            @endrole

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
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="user_id">User ID</label>
                        <input id="user_id" type="text" name="filter[user_id]" value="{{ request('filter.user_id') }}"
                               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div>
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="challan_id">Challan ID</label>
                        <input id="challan_id" type="text" name="filter[challan_id]" value="{{ request('filter.challan_id') }}"
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
                                Date
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Challan
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Old License No
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                New License No
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Renewal Date
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Expiry Date
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                RCMD BY
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Renewed By
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Status
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($licenses as $license)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-2 py-2  border-black font-medium  text-centertext-black dark:text-white">
                                    {{ $license->id }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ \Carbon\Carbon::parse($license->created_at)->format('d-m-Y') }}
                                </td>


                                <td class="border px-2 py-2  border-black font-medium text-left text-black dark:text-white">
                                    @if(!empty($license->user))
                                        {{ $license->user->name }}
                                    @endif
                                </td>



                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    @if(!empty($license->challan))
                                        <a href="{{ Storage::url($license->challan->challan_receipt_path) }}" class="text-blue-500 hover:underline" target="_blank">View</a>
                                    @else
                                        @if(auth()->user()->hasRole('Wiring Contractor'))
                                            <a href="{{ route('quota.create') }}" class="text-blue-500 hover:underline">Upload</a>
                                        @else
                                            Not Uploaded
                                        @endif
                                    @endif

                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $license->old_license_number }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $license->user->license_number }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $license->renewal_date }}
                                </td>


                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $license->license_expiry }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    @if(!empty($license->recommended_by))
                                        {{ \App\Models\User::find($license->recommended_by)->name }}
                                    @else
                                        Pending
                                    @endif

                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    @if(!empty($license->renewed_by))
                                        {{ \App\Models\User::find($license->renewed_by)->name }}
                                    @else
                                        Pending
                                    @endif
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    {{ $license->status }}
                                </td>

                                <td class="border px-2 py-2  border-black font-medium text-center text-black dark:text-white">
                                    @if($license->status == "Approved")
                                        <a href="{{ route('license.show', encrypt($license->id)) }}" class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Show
                                        </a>
                                    @else
                                        @role('Electric Inspector|DEI|AEI')
                                        <a href="{{ route('license.show', encrypt($license->id)) }}" class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Give Recommendation
                                        </a>
                                        @endrole
                                    @endif
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
