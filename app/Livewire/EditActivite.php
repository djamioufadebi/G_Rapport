<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use Livewire\Component;

class EditActivite extends Component
{
    public $nom;
    public $description;

    public $lieu;
    public $date_debut;
    public $date_fin;
    public $id_projet;
    public $taux_de_realisation;
    public $activite;
    public $activites;

    public $statut;
    public function mount()
    {
        $this->nom = $this->activites->nom;
        $this->description = $this->activites->description;
        $this->lieu = $this->activites->lieu;
        $this->date_debut = $this->activites->date_debut;
        $this->date_fin = $this->activites->date_fin;
        $this->id_projet = $this->activites->id_projet;
        $this->taux_de_realisation = $this->activites->taux_de_realisation;
        $this->statut = $this->activites->statut;

    }

    public function update(Activite $activite)
    {
        // recherche l'id de l'objet activite et on le prépare pour la modification
        $activite = Activite::find($this->activites->id);

        $this->validate([
            'nom' => 'string|required',
            'description' => 'string|required',
            'lieu' => 'string|required',
            'date_debut' => 'date|required',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'id_projet' => 'required',
            'statut' => 'string',
            'taux_de_realisation' => 'required|numeric|min:0|max:100',
        ]);

        try {
            $activite->nom = $this->nom;
            $activite->description = $this->description;
            $activite->lieu = $this->lieu;
            $activite->date_debut = $this->date_debut;
            $activite->date_fin = $this->date_fin;
            $activite->id_projet = $this->id_projet;
            $activite->taux_de_realisation = $this->taux_de_realisation;
            $activite->statut = $this->statut;
            $activite->save();

            return redirect()->Route('activites')->with(
                'miseajour',
                'Mise à jour du activite !'
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur d\'enregistrement du activite'
            );
        }
    }

    public function render()
    {

        $listeProjet = Projet::all();

        return view('livewire.edit-activite', compact('listeProjet'));
    }

}