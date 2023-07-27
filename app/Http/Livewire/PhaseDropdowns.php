<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class PhaseDropdowns extends Component
{
    public $selectedPhase;
    public $phaseTypes;

    public function render()
    {
        $phases = DB::table('phases')->get();
        return view('livewire.phase-dropdowns', compact('phases'));
    }

    public function updatedSelectedPhase($value)
    {
        $this->phaseTypes = DB::table('phase_types')
            ->where('phase_id', $value)
            ->get();
    }
}
