<?php

namespace App\Livewire;

use App\Models\Profil;
use App\Models\User;
use Livewire\Component;

class ShowUser extends Component
{
    public $selectedProfilId;
    public function confirmSaveIdProfil($id)
    {
        $user = User::find($id); // Récupérez l'utilisateur avec l'ID 1

        // associer le profil à l'utilisateur si un profil est selectionner
        if ($this->selectedProfilId != null) {
            $user->id_profil = $this->selectedProfilId;

            $user->save(); // Sauvegardez les modifications
            return redirect("users.show")->with('success', 'Success');
        } else {
            $user->id_profil = 1;

            $user->save(); // Sauvegardez les modifications
            return redirect("users.show")->with('success', 'Success');
        }

        // retourner sur la page des utilisateurs si aucun profil n'est selectionner
        // return redirect()->back();
    }
    public $users;
    public function render()
    {
        $users = $this->users;

        $listeProfil = Profil::all();


        return view('livewire.show-user', compact('users', 'listeProfil'));
    }
}
