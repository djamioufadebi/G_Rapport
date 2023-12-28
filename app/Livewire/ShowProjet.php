<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Projet;
use Livewire\Component;

class ShowProjet extends Component
{
    public $projets;

    public function nomClient()
    {

    }

    public function render()
    {

        //$projets = Projet::find(id);
        //dd($projets);


        $projets = $this->projets;
        // pour recupérer le client du projet
        $clients = Client::where('id', $projets->id_client)->first();

        return view('livewire.show-projet', compact('projets', 'clients'));
    }
}