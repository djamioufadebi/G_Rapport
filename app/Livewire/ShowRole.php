<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowRole extends Component
{
    public $roles;
    public function render()
    {
        // recuperer les profils ayant ce role

        $roles = $this->roles;
        return view('livewire.show-role', compact('roles'));
    }
}
