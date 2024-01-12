<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use App\Models\User;
use Livewire\Component;

class ShowRapport extends Component
{
    public $rapport;

    public function render()
    {
        $rapport = $this->rapport;

        $userRapport = User::where('id', $rapport->user_id)->first();

        $activites = Activite::where('id', $rapport->id_activite)->first();

        $projet = Projet::where('id', $activites->id_projet)->first();


        return view('livewire.show-rapport', compact('rapport', 'projet', 'activites', 'userRapport'));
    }
}