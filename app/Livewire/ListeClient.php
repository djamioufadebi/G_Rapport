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

    public $search;

    public function s()
    {
    }

    // fonction pour supprimer un Client avec une confirmation avant de suppression
    public function confirmDelete($id)
    {
        try {
            $selectedItemId = Client::findOrFail($id);
            if (!$this->canDeleteClient($selectedItemId)) {
                throw new \Exception('Impossible de supprimer ce client.');
            }

            $selectedItemId->delete();

            $this->selectedItemId = $selectedItemId;
            return redirect("clients")->with('delete', 'Le client à été supprimé');
        } catch (\Exception $e) {
            return redirect("clients")
                ->with('error', 'Impossible de supprimer ce client : Vous devez supprimer tous les enregistrements liés à ce client avant de le supprimer ');
        }

    }

    private function canDeleteClient($client)
    {
        // Vérifier s'il existe des relations avec le modèle projet
        $references = [
            'projet',
        ];
        foreach ($references as $relation) {
            if ($client->$relation()->count() > 0) {
                return false;
            }
        }
        return true;
    }

    public function render()
    {
        $word =  '%' . $this->search . '%';
        $clients = Client::where('nom', 'like', $word)
        ->orWhere('adresse', 'like', $word )
        ->orWhere('email', 'like', $word )
        ->orWhere('contact', 'like', $word )->latest()->paginate(10);
        
        return view('livewire.liste-client', compact('clients'));
    }
    
}
