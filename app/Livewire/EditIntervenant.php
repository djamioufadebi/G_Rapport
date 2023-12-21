<?php

namespace App\Livewire;

use App\Models\Intervenant;
use Exception;
use Livewire\Component;

class EditIntervenant extends Component
{

    public $intervenants;

    public $nom;
    public $prenom;
    public $email;
    public $contact;
    public $adresse;

    public function mount()
    {
        $this->nom = $this->intervenants->nom;
        $this->prenom = $this->intervenants->prenom;
        $this->email = $this->intervenants->email;
        $this->contact = $this->intervenants->contact;
        $this->adresse = $this->intervenants->adresse;
    }

    public function update(Intervenant $intervenant)
    {

        // la fonction find() permet de faire la recherche en fonction de l'id
        // dans le modèle Intervenant
        $intervenant = Intervenant::find($this->intervenants->id);

        $this->validate([
            'nom' => 'string|required',
            'prenom' => 'string|required',
            'contact' => 'integer|required|min:8',
            'email' => 'string|required',
            'adresse' => 'string|required',
        ]);

        // On vérifie si le nom d'intervenant existe déjà
        // $query = Intervenant::where('email', $this->email)->get();

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



        // if (count($query) > 0) {
        //  return redirect()->back()->with(
        //   'error',
        //   'Nom d\'intervenant déjà existant!'
        //  );
        // } else {

        // }

    }



    public function render()
    {
        return view('livewire.edit-intervenant');
    }
}