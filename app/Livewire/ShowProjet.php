<?php

namespace App\Livewire;

use Livewire\Component;

class ShowProjet extends Component
{
    public $projets;
    public function render()
    {
        $projets = $this->projets;
        return view('livewire.show-projet', compact('projets'));
    }
}