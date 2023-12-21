<?php

namespace App\Livewire;

use App\Models\Role;
use Exception;
use Livewire\Component;

class EditRole extends Component
{
    public $roles;

    public $nom;


    public function mount()
    {
        $this->nom = $this->roles->nom;
    }

    public function update()
    {
        // recherche l'id de l'objet role et on le prépare pour la modification
        $role = Role::find($this->roles->id);

        $this->validate([
            'nom' => 'string|required',
        ]);

        try {
            $role->nom = $this->nom;

            $role->save();

            return redirect()->Route('roles')->with(
                'success',
                'Mise à jour du role !'
            );
        } catch (Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur d\'enregistrement du role'
            );
        }
    }

    public function render()
    {
        return view('livewire.edit-role');
    }
}