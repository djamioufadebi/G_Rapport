<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowRapport extends Component
{
    public $rapport;

    public function render()
    {
        $rapport = $this->rapport;

        $userRapport = User::where('id', $rapport->user_id)->first();

        $projets = User::where('id', $rapport->id_projet)->first();

        return view('livewire.show-rapport', compact('rapport', 'userRapport', 'projets'));
    }
}
