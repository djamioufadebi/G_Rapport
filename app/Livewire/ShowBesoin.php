<?php

namespace App\Livewire;

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

        $projets = User::where('id', $besoins->id_projet)->first();

        return view('livewire.show-besoin', compact('besoins', 'userBesoin', 'projets'));
    }
}
