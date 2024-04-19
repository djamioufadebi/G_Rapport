<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Intervenant;
use Exception;
use Livewire\Component;

class CreateIntervenant extends Component
{

    public $nom;
    public $contact;
    public $prenom;
    public $email;
    public $id_activite;

    public $date_participation;

    public $adresse;

    public $intervenant;

    public function store(Intervenant $intervenant)
    {
        $this->validate([
            'nom' => 'string|required|unique:intervenants,nom',
            'prenom' => 'string|required',
            'contact' => 'integer|required',
            'email' => 'string|required|unique:intervenants,email',
            'adresse' => 'string|required',
            'id_activite' => 'required',
            'date_participation' => 'date|required',
        ]);

            try {
                $intervenant->nom = $this->nom;
                $intervenant->prenom = $this->prenom;
                $intervenant->email = $this->email;
                $intervenant->contact = $this->contact;
                $intervenant->adresse = $this->adresse;
                $intervenant->id_activite = $this->id_activite;
                $intervenant->date_participation = $this->date_participation;
                $intervenant->save();

                return redirect()->Route('intervenants')->with(
                    'success',
                    'Nouveau intervenant ajoutée !'
                );
            } catch (Exception $e) {
                return redirect()->back()->with(
                    'error',
                    'Erreur d\'enregistrement de l\'intervenant '
                );
            }
        

    }
    public function render()
    {
        $listeActivite = Activite::all();

        return view('livewire.create-intervenant', compact('listeActivite'));
    }
}
