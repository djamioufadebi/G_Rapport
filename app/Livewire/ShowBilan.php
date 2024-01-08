<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use Livewire\Component;

class ShowBilan extends Component
{
    public function render()
    {
        $projets = Projet::all();


        // récuperer le projet selectionné
        // $selectedProject = Projet::where('id', $projets->$this->id)->get();

        // recuperer toutes les activites qui appartient au projet sélectionné et les afficher
        // on peut faire un foreach pour parcourir les activites et les afficher dans le show-bilan
        // $selectedProjectActivites = Activite::where('id_projet', $projets->id)->get();

        $activites = Activite::all();

        return view('livewire.show-bilan', compact('projets', 'activites'));
    }
}