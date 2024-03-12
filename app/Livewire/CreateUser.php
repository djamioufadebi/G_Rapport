<?php

namespace App\Livewire;

use App\Models\Profil;
use App\Models\User;
use Livewire\Component;

class CreateUser extends Component
{
    public $nom;
    public $prenom;
    public $contact;
    public $email;
    public $id_profil;

    public $user;

    public function store(User $user)
    {
        $this->validate([
            'nom' => 'string|required',
            'prenom' => 'string|required',
            'contact' => 'string|required|min:8',
            'email' => 'string|required|unique:users,email',
            'id_profil' => 'integer|required',
        ]);

        // On récupère l'email de l'utilisateur en BDD
        $query = User::where('email', $this->email)->get();

        // On vérifie si l'email est déjà utilisé
        if (count($query) > 0) {

            $error = 'Cet email est déjà utilisé!';
            return redirect()->route('users.create')->with('dejatiliser', $error);
        } else {

            try {

                $user->nom = $this->nom;
                $user->prenom = $this->prenom;
                $user->email = $this->email;
                $user->contact = $this->contact;
                $user->id_profil = $this->id_profil;
                $user->save();

                return redirect()->Route('users')->with(
                    'success',
                    'Nouveau utilisateur ajouté ! '
                );
            } catch (\Exception $e) {
                return redirect()->back()->with(
                    'error',
                    'Erreur d\'enregistrement de l\'utilisateur'
                );
            }
        }
    }


    public function render()
    {

        $listeProfil = Profil::all();

        return view('livewire.create-user', compact('listeProfil'));
    }
}
