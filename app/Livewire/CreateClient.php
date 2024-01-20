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
            'contact' => 'integer|required|min:8',
        ]);

        // On recupère les Clients existants avec le nom et le prenom
        $query = Client::where('nom', $this->nom)->orwhere('email', $this->email)->get();
        // On verifie si l'Client existe déjà dans la base de données avec le nom et le prenom
        if (count($query) > 0) {

            $this->error = 'Ce Client existe déjà!';
            return redirect()->route('Clients.create')->with('dejatiliser', $this->error);
        } else {

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
    }
    public function render()
    {
        return view('livewire.create-client');
    }
}