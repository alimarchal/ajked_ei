<div class="grid grid-cols-1 md:grid-cols-1 gap-4 text-center mt-4">
    <table class="w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700">
        <tr>
            <th class="px-1 py-3 border border-black">
                Type
            </th>
            <th class="px-1 py-3 border border-black text-center">
                Watts
            </th>
            <th class="px-1 py-3 border border-black text-center">
                Nos
            </th>
            <th class="px-1 py-3 border border-black text-center">
                Total
            </th>
            <th class="px-1 py-3 border border-black text-center">
                Cable Sizes
            </th>

            <th class="px-1 py-3 border border-black text-center">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($loadDetails as $key => $loadDetail)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-black text-left">
                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                    <x-input id="type_{{ $key }}" class="block mt-1 w-full" type="text" name="type[]" wire:model="loadDetails.{{ $key }}.type" required />
                </td>
                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                    <x-input id="watts_{{ $key }}" class="block mt-1 w-full" type="number" step="0.01" name="watts[]" wire:model="loadDetails.{{ $key }}.watts" required />
                </td>
                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                    <x-input id="nos_{{ $key }}" class="block mt-1 w-full" type="number" step="0.01" name="nos[]" wire:model="loadDetails.{{ $key }}.nos" required />
                </td>
                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                    <x-input id="total_{{ $key }}" class="block mt-1 w-full" type="text" name="total[]" wire:model="loadDetails.{{ $key }}.total" readonly required />
                </td>
                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                    <x-input id="cable_sizes_{{ $key }}" class="block mt-1 w-full" type="text" name="cable_sizes[]" wire:model="loadDetails.{{ $key }}.cable_sizes" required />
                </td>
                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                    @if($key != 0)
                        <button wire:click.prevent="removeRow({{ $key }})" class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-red-800 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-white focus:bg-red-700 dark:focus:bg-white active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-4">Remove</button>
                    @endif

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <div class="flex items-center justify-center">
        <x-button wire:click.prevent="addRow" class="inline-flex items-center px-4 py-2 bg-blue-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-red-800 uppercase tracking-widest hover:bg-red-700 dark:hover:bg-white focus:bg-red-700 dark:focus:bg-white active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-4">
            {{ __('Add More') }}
        </x-button>
    </div>
</div>
