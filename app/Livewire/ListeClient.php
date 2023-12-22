<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ListeClient extends Component
{

    use WithPagination;

    public $client;
    public $selectedItemId;

    // fonction pour supprimer un Client avec une confirmation avant de suppression
    public function confirmDelete($id)
    {
        //  selectionner le Client à supprimer avec la fonction find() et le supprimer avec la fonction delete()
        $selectedItemId = Client::find($id)->delete();

        $this->selectedItemId = $selectedItemId;
        return redirect("clients")->with('delete', 'Le client à été supprimé');
    }

    public function render()
    {
        $clients = Client::latest()->paginate(10);
        return view('livewire.liste-client', compact('clients'));
    }
}
