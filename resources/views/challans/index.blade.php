<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ __('Challan Types') }}
        </h2>

        {{--            @can('create')--}}
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('challan.create') }}"
               class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700 dark:hover:text-black  dark:hover:bg-white ml-2">
                Generate New Challan
            </a>
        </div>
        {{--            @endcan--}}

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

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Challan No
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Created At
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Created By
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Challan For
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Amount
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Verified By
                            </th>


                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Status
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Print
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($challans as $challan)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ $challan->id }}
                                </th>

                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    {{ \Carbon\Carbon::parse($challan->created_at)->format('d-M-Y') }}
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $challan->user->name }}
                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $challan->challan_type->name }}
                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white">
                                    {{ number_format($challan->amount,2) }}
                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white">
                                    @if(!empty(\App\Models\User::find($challan->verified_by_user_id)))
                                        {{ \App\Models\User::find($challan->verified_by_user_id)->name }}
                                    @else
                                        Not Verified
                                    @endif
                                </th>


                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white">
                                    {{ $challan->status }}
                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white">
                                    <button onclick="redirectToLink('{{ route('challan.show', $challan->id) }}')" class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-black dark:border-gray-200 dark:hover:bg-white dark:bg-gray-700 ml-2" title="Members List">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    </button>
                                </th>



                        @endforeach

                        </tbody>
                    </table>


                </div>
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
