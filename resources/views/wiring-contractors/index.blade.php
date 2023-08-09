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
            {{ __('Wiring Contractors') }}
        </h2>


        <div class="flex justify-center items-center float-right">

            @can('create')
                <div class="flex justify-center items-center float-right">
                    <a href="{{ route('users.create') }}"
                       class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"
                       title="Members List">
                        <img src="https://img.icons8.com/?size=512&id=f3o1AGoVZ2Un&format=png" class="h-5 w-5" alt="">
                        <span class="hidden md:inline-block ml-2">Create New User</span>
                    </a>
                </div>
            @endcan



        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-0.5 bg-white overflow-x-auto dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->


                    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>
                            <th scope="col" class="px-1 py-3 border border-black ">
                                ID
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Role
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Mobile Number
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Division
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Sub-Div
                            </th>

                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($users as $user)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <th class="border px-2 py-2  border-black font-medium text-black dark:text-white">
                                    {{ $user->id }}
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white"
                                    width="20%">
                                    {{ $user->name }}
                                </th>


                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </th>


                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white">
                                    {{ $user->mobile_no }}
                                </th>


                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white">
                                    {{ $user->divisionSubDivision->division_name }}
                                </th>


                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white">
                                    {{ $user->divisionSubDivision->sub_division_name }}
                                </th>




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
