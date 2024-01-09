<?php

namespace App\Livewire;

use App\Models\Projet;
use Livewire\Component;

class ShowActivite extends Component
{
    public $activites;
    public function render()
    {
        $activites = $this->activites;
        $projets = Projet::where('id', $activites->id_projet)->first();
        return view('livewire.show-activite', compact('activites', 'projets'));
    }
}
