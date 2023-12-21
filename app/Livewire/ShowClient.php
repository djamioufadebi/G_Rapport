<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;

class ShowClient extends Component
{
    public $clients;

    public function render()
    {
        $clients = $this->clients;
        return view('livewire.show-client', compact('clients'));
    }
}
