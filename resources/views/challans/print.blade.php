<x-app-layout>
    <x-slot name="header" class="print:hidden">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Print Challan
        </h2>
    </x-slot>

    @push('custom_headers')
        <style>
            @media print {
                @page {
                    size: landscape;
                }
            }

            table, td, th {
                border: 1px solid;
                padding: 5px;
            }

            table {
                width: 100%;
                padding: 0px;
                margin: auto;
                border-collapse: collapse;
            }
        </style>
    @endpush

    <div class="py-0 px-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="print:flex">
                <div class="print:w-25 print:mr-3 print:ml-3 print:mt-6 ">
                    <h2 class="pt-2 pr-2 pl-2 text-center border-black border">
                        Azad Government of The State of Jammu & Kashmir<br>
                        Inspectorate of Electricity<br>
                        Consumer Copy
                    </h2>

                    <table>
                        <tr>
                            <th class="text-left" colspan="2">Challan No: {{ $challan->id }}</th>
                        </tr>
                        <tr>
                            <th class="text-left" colspan="2">Date: {{ \Carbon\Carbon::parse($challan->created_at)->format('d-M-Y') }}</th>
                        </tr>

                        <tr>
                            <th class="text-left" colspan="2"> Account No: AG-101</th>
                        </tr>
                        <tr>
                            <td class="p-2">Description</td>
                            <td class="p-2">Amount</td>
                        </tr>
                        <tr>
                            <td class="p-2" >{{ $challan->challan_type->name }}</td>
                            <td class="p-2">{{ number_format($challan->amount,2) }}</td>
                        </tr>

                        <tr style="border: none">
                            <td class="p-2" colspan="2">


                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </td>
                        </tr>


                        <tr>
                            <td class="p-2" colspan="2">{{ ucwords($amount_in_words) }}</td>
                        </tr>


                        <tr>
                            <td class="p-2">Total:</td>
                            <td class="p-2">{{ number_format($challan->amount,2) }}</td>
                        </tr>

                    </table>
                </div>
                <div class="print:w-25  print:mr-3  print:mt-6  ">
                    <h2 class="pt-2 pr-2 pl-2 text-center border-black border">
                        Azad Government of The State of Jammu & Kashmir<br>
                        Inspectorate of Electricity<br>
                        Bank Copy
                    </h2>

                    <table>
                        <tr>
                            <th class="text-left" colspan="2">Challan No: {{ $challan->id }}</th>
                        </tr>
                        <tr>
                            <th class="text-left" colspan="2">Date: {{ \Carbon\Carbon::parse($challan->created_at)->format('d-M-Y') }}</th>
                        </tr>

                        <tr>
                            <th class="text-left" colspan="2"> Account No: AG-101</th>
                        </tr>
                        <tr>
                            <td class="p-2">Description</td>
                            <td class="p-2">Amount</td>
                        </tr>
                        <tr>
                            <td class="p-2" >{{ $challan->challan_type->name }}</td>
                            <td class="p-2">{{ number_format($challan->amount,2) }}</td>
                        </tr>

                        <tr style="border: none">
                            <td class="p-2" colspan="2">


                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </td>
                        </tr>


                        <tr>
                            <td class="p-2" colspan="2">{{ ucwords($amount_in_words) }}</td>
                        </tr>


                        <tr>
                            <td class="p-2">Total:</td>
                            <td class="p-2">{{ number_format($challan->amount,2) }}</td>
                        </tr>

                    </table>
                </div>
                <div class="print:w-25 print:mr-3  print:mt-6 ">
                    <h2 class="pt-2 pr-2 pl-2 text-center border-black border">
                        Azad Government of The State of Jammu & Kashmir<br>
                        Inspectorate of Electricity<br>
                        Office Copy
                    </h2>

                    <table>
                        <tr>
                            <th class="text-left" colspan="2">Challan No: {{ $challan->id }}</th>
                        </tr>
                        <tr>
                            <th class="text-left" colspan="2">Date: {{ \Carbon\Carbon::parse($challan->created_at)->format('d-M-Y') }}</th>
                        </tr>

                        <tr>
                            <th class="text-left" colspan="2"> Account No: AG-101</th>
                        </tr>
                        <tr>
                            <td class="p-2">Description</td>
                            <td class="p-2">Amount</td>
                        </tr>
                        <tr>
                            <td class="p-2" >{{ $challan->challan_type->name }}</td>
                            <td class="p-2">{{ number_format($challan->amount,2) }}</td>
                        </tr>

                        <tr style="border: none">
                            <td class="p-2" colspan="2">


                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </td>
                        </tr>


                        <tr>
                            <td class="p-2" colspan="2">{{ ucwords($amount_in_words) }}</td>
                        </tr>


                        <tr>
                            <td class="p-2">Total:</td>
                            <td class="p-2">{{ number_format($challan->amount,2) }}</td>
                        </tr>

                    </table>
                </div>
                <div class="print:w-25  print:mr-3  print:mt-6 ">
                    <h2 class="pt-2 pr-2 pl-2 text-center border-black border">
                        Azad Government of The State of Jammu & Kashmir<br>
                        Inspectorate of Electricity<br>
                        AG Copy
                    </h2>

                    <table>
                        <tr>
                            <th class="text-left" colspan="2">Challan No: {{ $challan->id }}</th>
                        </tr>
                        <tr>
                            <th class="text-left" colspan="2">Date: {{ \Carbon\Carbon::parse($challan->created_at)->format('d-M-Y') }}</th>
                        </tr>

                        <tr>
                            <th class="text-left" colspan="2"> Account No: AG-101</th>
                        </tr>
                        <tr>
                            <td class="p-2">Description</td>
                            <td class="p-2">Amount</td>
                        </tr>
                        <tr>
                            <td class="p-2" >{{ $challan->challan_type->name }}</td>
                            <td class="p-2">{{ number_format($challan->amount,2) }}</td>
                        </tr>

                        <tr style="border: none">
                            <td class="p-2" colspan="2">


                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </td>
                        </tr>


                        <tr>
                            <td class="p-2" colspan="2">{{ ucwords($amount_in_words) }}</td>
                        </tr>

                        <tr>
                            <td class="p-2">Total:</td>
                            <td class="p-2">{{ number_format($challan->amount,2) }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('modals')
        <script>
            window.onload = function() {
                window.print();
            };
        </script>
    @endpush
</x-app-layout>
