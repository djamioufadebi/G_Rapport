<?php

namespace App\Livewire;

use App\Models\Role;
use Livewire\Component;

class CreateRole extends Component
{
    public $nom;
    public $role;

    public function store(Role $role)
    {
        $this->validate([
            'nom' => 'string|required',
        ]);

        try {
            $role->nom = $this->nom;

            $role->save();

            return redirect()->Route('roles')->with(
                'success',
                'Nouveau role ajoutée ! '
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur d\'enregistrement du role '
            );

        }

    }
    public function render()
    {
        return view('livewire.create-role');
    }
}