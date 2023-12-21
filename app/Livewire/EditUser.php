<?php

namespace App\Livewire;

use App\Models\Profil;
use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $nom;
    public $prenom;
    public $contact;
    public $email;
    public $id_profil;

    public $user;
    public $users;

    public function mount()
    {
        $this->nom = $this->users->nom;
        $this->prenom = $this->users->prenom;
        $this->contact = $this->users->contact;
        $this->email = $this->users->email;
        $this->id_profil = $this->users->id_profil;
    }

    public function update(User $user)
    {
        // recherche l'id de l'objet User et on le prépare pour la modification
        $user = User::find($this->users->id);
        $this->validate([
            'nom' => 'string|required',
            'prenom' => 'string|required',
            'contact' => 'string|required',
            'email' => 'string|required|unique:users,email',
            'id_profil' => 'integer|required',
        ]);

        try {

            $user->nom = $this->nom;
            $user->prenom = $this->prenom;
            $user->email = $this->email;
            $user->contact = $this->contact;
            $user->id_profil = $this->id_profil;
            $user->save();

            return redirect()->Route('users')->with(
                'edition',
                'Mise à jour de l\'utilisateur ! '
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur de mis à jour de l\'utilisateur'
            );
        }
    }


    public function render()
    {
        $listeProfil = Profil::all();
        return view('livewire.edit-user', compact('listeProfil'));
    }
}
