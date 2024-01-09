<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;

class ShowBilan extends Component
{

    public function mount()
    {
        //$projets = Projet::all();
        // dd($projets);
    }
    public function render()
    {
        $projets = Projet::with('projet')->get();
        dd($projets);

        $projets = Projet::all();

        // Récupérer les rapports avec les détails associés depuis les différentes tables liées
        $rapports = Rapport::with('projet', 'activite', 'intervenant', 'user')->get();

        $activites = Activite::all();

        return view('livewire.show-bilan', compact('projets', 'activites'));
    }
}