<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowProfils extends Component
{
    public $profils;
    public function render()
    {
        $profils = $this->profils;

        // recuperer les utlisteur ayant le profil actif
        $Users = User::where('id_profil', $profils->id);

        return view('livewire.show-profils', compact('profils', 'Users'));
    }
}