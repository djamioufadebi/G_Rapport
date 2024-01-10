<?php

namespace App\Livewire;

use App\Models\Projet;
use App\Models\User;
use Livewire\Component;

class ShowBesoin extends Component
{
    public $besoins;

    public function render()
    {
        $besoins = $this->besoins;
        // pour recupérer l'utilisateur qui a fait le besoin
        $userBesoin = User::where('id', $besoins->user_id)->first();

        $activites = User::where('id', $besoins->id_activite)->first();

        $projet = Projet::where('id', $activites->id)->get('libelle');

        //dd($projet);

        return view('livewire.show-besoin', compact('besoins', 'userBesoin', 'activites', 'projet'));
    }
}