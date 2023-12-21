<?php

namespace App\Livewire;

use Livewire\Component;

class ShowBesoin extends Component
{
    public $besoins;

    public function render()
    {
        $besoins = $this->besoins;
        return view('livewire.show-besoin', compact('besoins'));
    }
}
