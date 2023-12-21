<?php

namespace App\Livewire;

use App\Models\Intervenant;
use Exception;
use Livewire\Component;

class CreateIntervenant extends Component
{

    public $nom;
    public $contact;
    public $prenom;
    public $email;

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
        ]);

        try {
            $intervenant->nom = $this->nom;
            $intervenant->prenom = $this->prenom;
            $intervenant->email = $this->email;
            $intervenant->contact = $this->contact;
            $intervenant->adresse = $this->adresse;
            $intervenant->save();

            return redirect()->Route('intervenants')->with(
                'success',
                'Nouveau intervenant ajoutée ! '
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
        return view('livewire.create-intervenant');
    }
}