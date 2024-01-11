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

        // récuperer les activités de l'utilisateur connecté
        $projets = Projet::all();

        $activites = Activite::all();


        return view('livewire.show-bilan', compact('projets', 'activites'));
    }

}