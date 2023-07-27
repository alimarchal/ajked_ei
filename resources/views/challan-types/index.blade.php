<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ __('Challan Types') }}
        </h2>

{{--            @can('create')--}}
                <div class="flex justify-center items-center float-right">
                    <a href="{{ route('challanType.create') }}" class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:bg-gray-700  dark:hover:bg-gray-700 ml-2">
                        Create New Challan Type
                    </a>
                </div>
{{--            @endcan--}}

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white overflow-x-auto dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->


                    <table
                        class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>
                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                ID
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Created By
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Amount
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($challan_types as $challan_type)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <th class="border px-2 py-2  border-black font-medium text-black text-center dark:text-white">
                                    <a href="{{ route('challanType.edit', $challan_type->id) }}" class="hover:underline text-blue-500">{{ $challan_type->id }}</a>
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $challan_type->user->name }}
                                </th>


                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white">
                                    {{ $challan_type->name }}
                                </th>


                                <th class="border px-2 py-2 border-black font-medium text-center text-black dark:text-white">
                                    {{ number_format($challan_type->amount,2) }}
                                </th>

                        @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
