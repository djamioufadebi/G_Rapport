<?php

namespace App\Livewire;

use Livewire\Component;

class ShowRapport extends Component
{
    public $rapport;

    public function render()
    {
        $rapport = $this->rapport;
        return view('livewire.show-rapport', compact('rapport'));
    }
}
