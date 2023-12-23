<?php

namespace App\Livewire;

use App\Models\Profil;
use Livewire\Component;
use Livewire\WithPagination;

class ListeProfil extends Component
{
    public string $search = '';

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
         */
        $word = '%' . $this->search . '%';

        if (strlen($this->search) > 2) {

            $this->profils = Profil::query()->where('nom', 'Like', $word)->get();
            dd($this->profiles);
        }

        $profils = Profil::latest()->paginate(10);

        return view('livewire.liste-profil', compact('profils'));
    }
}
