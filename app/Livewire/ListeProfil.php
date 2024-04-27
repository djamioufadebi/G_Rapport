<?php

namespace App\Livewire;

use App\Models\Profil;
use Livewire\Component;
use Livewire\WithPagination;

class ListeProfil extends Component
{

    public $id;
    public $profil;

    use WithPagination;

    // Le code pour spécifier qu'on veut utiliser le theme de bootstrap pour la pagination
    protected $paginationTheme = 'bootstrap';

    // champs pour la selection d'un profil
    public $selectedItemId;
    public $search;

    public function s () {}
    

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
        $profils = Profil::where('nom', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.liste-profil', compact('profils'));
    }
}
