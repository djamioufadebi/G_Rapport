<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Profil;
use Livewire\Component;
use Livewire\WithPagination;

class ListeUser extends Component
{
    use WithPagination;
    public $selectedProfilId;
    public $search;
    public function s()
    {

    }
    public function confirmDelete($id)
    {
        // selectionner l' utilisateur à supprimer avec la fonction find() et le supprimer avec la fonction delete()
        User::find($id)->delete();

        return redirect("users")->with('delete', 'L\'utilisateur à été supprimé');
    }

    public function confirmSaveIdProfil($id)
    {
        $user = User::find($id); // Récupérez l'utilisateur avec l'ID 1

        // associer le profil à l'utilisateur si un profil est selectionner
        if ($this->selectedProfilId != null) {

            $user->id_profil = $this->selectedProfilId;
            $user->save(); // Sauvegardez les modifications
            $message = "Le profil" . $this->selectedProfilId . " est attribué à l'utilisateur" . $user->nom . "!";
            return redirect("users")->with('attribution', $message);
        } else {
            return redirect("users")->with('attributionerror', 'Veuillez selectionner un profil avant de sauvegarder l\'utilisateur');
        }
    }

    public function render()
    {
        $listeProfil = Profil::all();

        $word = '%' . $this->search . '%';
        $listeUsers = User::with(['profil:id,nom'])->where('nom', 'like', $word )
        ->orWhere('prenom', 'like', $word )
        ->orWhere('email', 'like', $word )->latest()->paginate(10);

        return view('livewire.liste-user', compact('listeUsers', 'listeProfil'));
    }
}
