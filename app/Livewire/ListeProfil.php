<?php

namespace App\Livewire;

use App\Models\Profil;
use Livewire\Component;
use Livewire\WithPagination;

class ListeProfil extends Component
{
    public $search = '';

    public $id;
    public $profil;

    use WithPagination;

    // champs pour la selection d'un profil
    public $selectedItemId;

    // fonction pour supprimer un profil avec une confirmation avant de suppression
    public function confirmDelete($id)
    {
        //  selectionner le profil à supprimer avec la fonction find() et le supprimeravec la fonction delete()
        $selectedItemId = Profil::find($id)->delete();
        $this->selectedItemId = $selectedItemId;
        return redirect("profils")->with('delete', 'Le profil à été supprimé');
    }

    public function render()
    {
        /**
         * Condition permettant de faire les recherches en fonction du nom ,
         du prenom
         */
        //$this->users = User::query()
        //     ->where('name', 'like', '%' . $this->search . '%')
        //     ->orWhere('email', 'like', '%' . $this->search . '%')
        // Ajoutez d'autres champs pour la recherche
        //   ->get();
        $profils = Profil::paginate(10);

        if (!empty($this->search)) {

            $profils = Profil::query()->where('nom', 'Like', '%'
                . $this->search . '%')->paginate(5);

        } else {
            $profils = Profil::latest()->paginate(10);
        }

        //$profils = Profil::paginate(10);

        return view('livewire.liste-profil', compact('profils'));
    }
}