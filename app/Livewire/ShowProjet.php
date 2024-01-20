<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Client;
use App\Models\Projet;
use App\Models\User;
use Livewire\Component;

class ShowProjet extends Component
{
    public $projets;

    public function render()
    {
        $projets = $this->projets;

        $userProjet = User::where('id', $projets->id_user)->first();




        // pour recupérer le client du projet
        $clients = Client::where('id', $projets->id_client)->first();

        // liste des activités de ce projet
        $listeActivite = Activite::where('id_projet', $projets->id)->get();

        $nomGestionnaire = User::where('id', $projets->id_gestionnaire)->first();

        return view(
            'livewire.show-projet',
            compact(
                'projets',
                'clients',
                'userProjet',
                'listeActivite',
                'nomGestionnaire'
            )
        );
    }
}
