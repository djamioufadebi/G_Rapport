<?php

namespace App\Livewire;

use App\Models\Client;
use Exception;
use Livewire\Component;

class EditClient extends Component
{

    public $clients;

    public $nom;
    public $adresse;
    public $email;
    public $contact;

    public function mount()
    {
        $this->nom = $this->clients->nom;
        $this->adresse = $this->clients->adresse;
        $this->email = $this->clients->email;
        $this->contact = $this->clients->contact;
    }

    public function update(Client $client)
    {

        // la fonction find() permet de faire la recherche en fonction de l'id
        // dans le modèle Client
        $client = Client::find($this->clients->id);

        $this->validate([
            'nom' => 'string|required',
            'adresse' => 'string|required',
            'contact' => 'integer|required|min:8',
            'email' => 'string|required',
        ]);

        // On vérifie si le nom d'client existe déjà
        // $query = Client::where('email', $this->email)->get();

        try {
            $client->nom = $this->nom;
            $client->adresse = $this->adresse;
            $client->email = $this->email;
            $client->contact = $this->contact;
            $client->save();

            return redirect()->Route('clients')->with(
                'success',
                'Client mis à jour ! '
            );
        } catch (Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur d\'enregistrement de l\'client '
            );
        }


    }
    public function render()
    {
        return view('livewire.edit-client');
    }
}