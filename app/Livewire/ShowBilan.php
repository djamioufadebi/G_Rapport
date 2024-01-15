<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;

class ShowBilan extends Component
{
    public $projets;
    public $activite;
    public function mount()
    {
        $this->projets = Projet::all();
    }

    // recupérer l'activité en cours selectionnée
    public function getActivite()
    {
        $activite = Activite::find($this->id_activite);
        $rapport = Rapport::where('id_activite', $activite->id)->first();
        dd($rapport);
        return $rapport;
    }

    // recuperer l'activité selectionnée par l'utilisateur
    public function getActiviteId()
    {
        $activite = Activite::find($this->id);
        return $activite->id;
    }



    public function render()
    {

        // récuperer les activités de l'utilisateur connecté
        $projets = Projet::all();

        $activites = Activite::all();

        return view('livewire.show-bilan', compact('projets', 'activites'));
    }

}
