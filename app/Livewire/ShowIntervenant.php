<?php

namespace App\Livewire;

use App\Models\Activite;
use Livewire\Component;

class ShowIntervenant extends Component
{
    public $intervenants;
    public function render()
    {
        $intervenants = $this->intervenants;

        // recuperer les activités auxquelles les intervenants sont affectés
        //$activites = Activite::where('id', $intervenants->id_activite)->get();


        return view('livewire.show-intervenant', compact('intervenants'));
    }
}