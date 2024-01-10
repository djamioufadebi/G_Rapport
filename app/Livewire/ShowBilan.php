<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;

class ShowBilan extends Component
{

    public $activites;
    public $projets;
    public function mount()
    {
        $this->projets = Projet::all();
    }
    public function render()
    {
        $activites = Activite::all();

        // récuperer automatique le projet auquel appartient l'activité sélectionnée
        // recupérer le projet de l'activité sélectionnée
        //$projet = Projet::where('id', $activites->id_projet)->first();


        return view('livewire.show-bilan', compact('activites', 'projets'));
    }

}
