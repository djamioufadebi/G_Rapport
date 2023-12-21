<?php

namespace App\Livewire;

use Livewire\Component;

class ShowIntervenant extends Component
{
    public $intervenants;
    public function render()
    {
        $intervenants = $this->intervenants;
        return view('livewire.show-intervenant', compact('intervenants'));
    }
}