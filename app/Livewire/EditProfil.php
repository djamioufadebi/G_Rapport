<?php

namespace App\Livewire;

use App\Models\Profil;
use Livewire\Component;

class EditProfil extends Component
{

    public $profils;

    public $nom;


    public function mount()
    {
        $this->nom = $this->profils->nom;
    }

    public function update()
    {
        // recherche l'id de l'objet profil et on le prépare pour la modification
        $profil = Profil::find($this->profils->id);

        $this->validate([
            'nom' => 'string|required',
        ]);

        try {
            $profil->nom = $this->nom;

            $profil->save();

            return redirect()->Route('profils')->with(
                'modify',
                'Mise à jour du profil !'
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur d\'enregistrement du profil'
            );
        }
    }

    public function render()
    {
        return view('livewire.edit-profil');
    }
}
