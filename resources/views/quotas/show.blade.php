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
            Quota Request from {{ $quota->user->name }}
        </h2>


    </x-slot>

        <div class="py-6">
            <div class="max-w-7xl mx-auto ">
                <div class="bg-white px-4 dark:bg-gray-800 overflow-hidden content rounded shadow-lg pb-4">
                    <div class="grid grid-cols-3 gap-4 pt-4">
                        <div></div>
                        <!-- Empty column for spacing -->
                        <div class="flex items-center justify-center">
                            <img src="{{ Storage::url('logo.png') }}" alt="Logo" class="h-16 mx-auto">
                        </div>
                    </div>
                    {{--                <img src="{{ Storage::url('logo.png') }}" alt="Logo Government" class="h-16 mx-auto">--}}
                    <h3 class="text-lg text-center font-extrabold">
                        Government of Azad Jammu & Kashmir
                    </h3>
                    <h1 class="text-lg text-center font-extrabold">Inspectorate of Electricity</h1>



                    <table class="w-full  text-sm mt-2 border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <tbody style="font-size: 14px;">
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Applied By
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                @if(!empty($quota->user))
                                    {{ $quota->user->name }}
                                @endif
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Quota
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                {{ $quota->phase_type->type }}
                            </td>
                        </tr>
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Type
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                {{ $quota->type }}
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Requested Quantity
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                {{ $quota->quantity }}
                            </td>
                        </tr>

                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Opening Balance
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                {{ $quota->outstanding_balance }}
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Challan No
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                <a href="{{ route('challan.show', $quota->challan_id) }}" target="_blank" class="text-blue-500 hover:underline">{{ $quota->challan_id }}</a>
                            </td>
                        </tr>

                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Challan Amount
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                {{ number_format($quota->challan->amount,2) }}
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Challan Paid Copy
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
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
                        </tr>

                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Test Report
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                @if(!empty($quota->test_report_id))
                                    {{ $quota->test_report_id }}
                                @else
                                    N/A
                                @endif

                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="20%">
                                Division
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" width="30%">
                                {{ $quota->divisionSubDivision->division_name }}
                            </td>
                        </tr>


                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Sub-Division
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $quota->divisionSubDivision->sub_division_name }}
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                CNIC
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $quota->user->cnic }}
                            </td>
                        </tr>
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Mobile No
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $quota->user->mobile_no }}
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                License Number
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{  $quota->user->license_number }}
                            </td>
                        </tr>

                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                License  Expiry
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                @if(!empty($quota->user->license_number_expiry))
                                    {{ \Carbon\Carbon::parse($quota->user->license_number_expiry)->format('d-M-Y') }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Recommended By
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                @if(!empty($quota->recommended_by))
                                    {{ \App\Models\User::find($quota->recommended_by)->name }}
                                @else
                                    Pending
                                @endif
                            </td>
                        </tr>
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Approved By
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                @if(!empty($quota->approved_by))
                                    {{ \App\Models\User::find($quota->approved_by)->name }}
                                @else
                                    Pending
                                @endif
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Status
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                {{ $quota->status }}
                            </td>
                        </tr>
                        <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white">
                                Address:
                            </td>
                            <td class="border px-1 py-0.5 border-black font-medium text-black dark:text-white" colspan="3">
                                {{ $quota->user->address }}
                            </td>
                        </tr>
                        </tbody>
                    </table>


                    @if(!empty($quota->recommended_by))
                        <div class="grid grid-cols-1 gap-4">
                            <div class="mt-1 text-justify p-2" style="border: 1px solid black;font-size: 12px;">
                                Name: {{ $quota->recommendedBy->name }} - Designation: {{ $quota->recommendedBy->roles->first()->name }}
                                <br>
                                <p>
                                    {{ $quota->recommended_by_remarks }}
                                </p>

                            </div>
                        </div>
                    @endif


                    @if(!empty($quota->approved_by))
                        <div class="grid grid-cols-1 gap-4">
                            <div class="mt-1 text-justify p-2" style="border: 1px solid black;font-size: 12px;">
                                Name: {{ $quota->approvedBy->name }} - Designation: {{ $quota->approvedBy->roles->first()->name }}
                                <br>
                                <p>
                                    {{ $quota->approved_by_remarks }}
                                    <br>
                                    Status: {{ $quota->status }}
                                </p>

                            </div>
                        </div>
                    @endif



                    @role('DEI|AEI')
                    @if(empty($quota->recommended_by))
                        <form method="POST" action="{{ route('quota.update', encrypt($quota->id)) }}" class="mb-4">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-4">
                                <div class="mt-4 p-4">
                                    <x-label for="recommended_by_remarks" value="{{ __('Recommended Remarks') }}"/>
                                    <textarea required name="recommended_by_remarks" id="recommended_by_remarks" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                                </div>
                            </div>
                            <div class="flex items-center justify-end">
                                <x-button class="ml-4">
                                    {{ __('Submit') }}
                                </x-button>
                            </div>
                        </form>
                    @endif
                    @endrole


                    @role('Electric Inspector')
                    @if(empty($quota->approved_by))
                        <form method="POST" action="{{ route('quota.update', encrypt($quota->id)) }}" class="mb-4">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-4">
                                <div class="mt-4 px-4">
                                    <x-label for="status" value="{{ __('Please select Approved / Rejected') }}"/>
                                    <select name="status" id="status" required
                                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option value="">Please Select Option.</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>

                                <div class="px-4">
                                    <x-label for="approved_by_remarks" value="{{ __('Remarks') }}"/>
                                    <textarea required name="approved_by_remarks" id="approved_by_remarks" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4 mb-4 px-4">
                                <x-button class="ml-4">
                                    {{ __('Submit') }}
                                </x-button>
                            </div>
                        </form>
                    @endif
                    @endrole

                </div>
            </div>
        </div>




        @push('modals')
            <script>
                // // Execute this code on page load
                // document.addEventListener("DOMContentLoaded", function () {
                //     // Store the current window height before opening the print dialog
                //     const initialHeight = window.innerHeight;
                //
                //     // Show the print dialog when the page loads
                //     window.print();
                //
                //     // Wait for a short period (e.g., 1 second) and then check the window height again
                //     setTimeout(function () {
                //         const currentHeight = window.innerHeight;
                //
                //         // If the window height decreased, it indicates that the print dialog is open
                //         // If the window height remains the same, it means the user pressed "Cancel"
                //         if (currentHeight === initialHeight) {
                //             // Go back to the previous page
                //             window.history.back();
                //         }
                //     }, 1000); // Adjust the delay time as needed
                // });

                // Define the redirectToLink function
                function redirectToLink(url) {
                    window.location.href = url;
                }
            </script>
        @endpush
</x-app-layout>
