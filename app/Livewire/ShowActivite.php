<?php

namespace App\Livewire;

use Livewire\Component;

class ShowActivite extends Component
{
    public $activites;
    public function render()
    {
        $activites = $this->activites;
        return view('livewire.show-activite', compact('activites'));
    }
}
