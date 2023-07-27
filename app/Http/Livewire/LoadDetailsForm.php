<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LoadDetailsForm extends Component
{
    public $loadDetails = [
        [
            'type' => '',
            'watts' => '',
            'nos' => '',
            'cable_sizes' => '',
        ]
    ];

    public function addRow()
    {
        $this->loadDetails[] = [
            'type' => '',
            'watts' => '',
            'nos' => '',
            'cable_sizes' => '',
        ];
    }

    public function removeRow($index)
    {
        unset($this->loadDetails[$index]);
        $this->loadDetails = array_values($this->loadDetails); // Re-index the array after removal
    }

    public function updatedLoadDetails()
    {
        // Automatically calculate the "Total" for each row when "Watts" or "Nos" is updated
        foreach ($this->loadDetails as $key => $loadDetail) {
            $watts = (double)$loadDetail['watts'];
            $nos = (double)$loadDetail['nos'];
            $this->loadDetails[$key]['total'] = (double)($watts * $nos);
        }
    }



    public function render()
    {
        return view('livewire.load-details-form');
    }
}
