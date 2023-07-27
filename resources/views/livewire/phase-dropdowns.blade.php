<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>

        <select wire:model="selectedPhase" required name="phase_id" id="selectedPhase" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="">Select a phase</option>
            @foreach ($phases as $phase)
                <option value="{{ $phase->id }}">{{ $phase->name }}</option>
            @endforeach
        </select>
    </div>


    <div>
        <select id="selectedPhaseType" required name="phase_type_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            <option value="" selected>None</option>
            @if(!empty($selectedPhase))
                @foreach ($phaseTypes as $phaseType)
                    <option value="{{ $phaseType->id }}">{{ $phaseType->type }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>

