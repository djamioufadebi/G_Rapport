<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;

class CreateClient extends Component
{
    public $nom;
    public $contact;
    public $adresse;
    public $email;

    public $client;

    public function store(Client $client)
    {
        $this->validate([
            'nom' => 'string|required|unique:clients,nom',
            'adresse' => 'string|required',
            'email' => 'string|required',
            'contact' => 'integer|required',
        ]);

        try {

            $client->nom = $this->nom;
            $client->adresse = $this->adresse;
            $client->email = $this->email;
            $client->contact = $this->contact;
            $client->save();

            return redirect()->Route('clients')->with(
                'success',
                'Nouveau client ajoutée ! '
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur d\'enregistrement du client '
            );
        }
    }
    public function render()
    {
        return view('livewire.create-client');
    }
}
