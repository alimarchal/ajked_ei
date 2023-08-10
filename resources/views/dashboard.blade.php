<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} {{ optional($user->roles->first())->name }}
            @role('Wiring Contractor')
                License Expiry Date: {{ Carbon\Carbon::parse($user->license_number_expiry)->format('d-M-Y') }}
            @endrole
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">--}}
            {{--                <x-welcome />--}}
            {{--            </div>--}}


            @role('Wiring Contractor')
            <div class="grid grid-cols-12 gap-6 ">
                <a href="{{ route('quota.index') }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $wc_quota }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Allotted Quota
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=12780&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index') }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $total_wc_test_reports }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Test Report Forms
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endrole


            @role('SDO|X-En')
            <div class="grid grid-cols-3 gap-6 ">
                <a href="{{ route('testReport.index',['filter[sdo_verified]=0&filter[xen_verified]=0']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $pending_test_reports }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Test Reports Pending Actions
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=12780&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index',['filter[status]=Approved&filter[phase_id]=2']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $approved_test_reports }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Approved Test Reports (3-P)
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index',['filter[status]=Objection']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $objection_test_reports }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Objected Test Reports
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index',['filter[phase_id]=1']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $seen_test_reports_1p }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Seen Test Reports (1-P)
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('wiringContractor.index') }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $wiring_contractor_users }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    List of Wiring Contractors
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endrole



            @role('DEI|AEI')
            <div class="grid grid-cols-3 gap-6 ">
                <a href="{{ route('testReport.index',['filter[status]=Approved&filter[phase_id]=2']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $noc_issued }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Issued NOC
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=12780&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index',['filter[dei_verified]=0&filter[aei_verified]=0&filter[status]=In-Process']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $pending_test_reports_approval }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Pending Approval
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index',['filter[dei_verified]=1&filter[aei_verified]=1&filter[ei_verified]=0&filter[status]=In-Process']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $submit_to_electric_inspector }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Submitted to Electric Inspector
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index',['filter[phase_id]=1']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $seen_test_reports_1p }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Seen Test Reports (1-P)
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index',['filter[status]=Objection']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $noc_objection }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Pending Due to Objection
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endrole

            @role('Electric Inspector|Super-Admin')
            <div class="grid grid-cols-3 gap-6 ">
                <a href="{{ route('testReport.index',['filter[status]=Approved&filter[phase_id]=2']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $noc_issued }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Issued NOC
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=12780&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index',['filter[dei_verified]=1&filter[aei_verified]=1&filter[status]=In-Process']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $submit_to_electric_inspector }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Pending Approval Sub-Offices
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('testReport.index',['filter[status]=Objection']) }}" class="transform  hover:scale-110 transition duration-300  shadow-xl rounded-lg col-span-12 sm:col-span-12 xl:col-span-1 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ $noc_objection }}
                                </div>
                                <div class="mt-1 text-base font-extrabold text-black">
                                    Pending Due to Objection
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=DEiiONGr4Fjl&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            @endrole
        </div>
    </div>
</x-app-layout>
