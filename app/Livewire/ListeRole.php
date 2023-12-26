<?php

namespace App\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class ListeRole extends Component
{
    public $id;
    public $role;

    use WithPagination;

    // champs pour la selection d'un role
    public $selectedItemId;

    public $search;
    
    public function s () {}

    // fonction pour supprimer un role avec une confirmation avant de suppression
    public function confirmDelete($id)
    {
        //  selectionner le role à supprimer avec la fonction find() et le supprimeravec la fonction delete()
        $selectedItemId = Role::find($id)->delete();
        $this->selectedItemId = $selectedItemId;
        return redirect("roles")->with('delete', 'Le role à été supprimé');
    }
    public function render()
    {
        $roles = Role::where('nom', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.liste-role', compact('roles'));
    }

}