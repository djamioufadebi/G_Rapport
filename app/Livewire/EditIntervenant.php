<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Intervenant;
use Exception;
use Livewire\Component;

class EditIntervenant extends Component
{

    public $intervenants;

    public $nom;
    public $prenom;
    public $email;
    public $id_activite;
    public $date_participation;
    public $contact;
    public $adresse;

    public function mount()
    {
        $this->nom = $this->intervenants->nom;
        $this->prenom = $this->intervenants->prenom;
        $this->email = $this->intervenants->email;
        $this->contact = $this->intervenants->contact;
        $this->adresse = $this->intervenants->adresse;
        $this->id_activite = $this->intervenants->id_activite;
        $this->date_participation = $this->intervenants->date_participation;

    }

    public function update(Intervenant $intervenant)
    {
        $intervenant = Intervenant::find($this->intervenants->id);

        $this->validate([
            'nom' => 'string|required',
            'prenom' => 'string|required',
            'contact' => 'integer|required|min:8',
            'email' => 'string|required',
            'adresse' => 'string|required',
            'id_activite' => 'required',
            'date_participation' => 'date|required'

        ]);

        try {
            $intervenant->nom = $this->nom;
            $intervenant->prenom = $this->prenom;
            $intervenant->email = $this->email;
            $intervenant->contact = $this->contact;
            $intervenant->adresse = $this->adresse;
            $intervenant->id_activite = $this->id_activite;
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
        $listeActivite = Activite::all();
        return view('livewire.edit-intervenant', compact('listeActivite'));
    }
}