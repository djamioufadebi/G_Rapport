<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use Livewire\Component;

class EditActivite extends Component
{
    public $nom;
    public $description;
    public $date_debut;
    public $date_fin;
    public $id_projet;
    public $taux_de_realisation;
    public $activite;
    public $activites;
    public function mount()
    {
        $this->nom = $this->activites->nom;
        $this->description = $this->activites->description;
        $this->date_debut = $this->activites->date_debut;
        $this->date_fin = $this->activites->date_fin;
        $this->id_projet = $this->activites->id_projet;
        $this->taux_de_realisation = $this->activites->taux_de_realisation;

    }

    public function update(Activite $activite)
    {
        // recherche l'id de l'objet activite et on le prépare pour la modification
        $activite = Activite::find($this->activites->id);

        $this->validate([
            'nom' => 'string|required',
            'description' => 'string|required',
            'date_debut' => 'date|required',
            'date_fin' => 'date|required',
            'id_projet' => 'required',
            'taux_de_realisation' => 'required|numeric|between:0,100',
        ]);

        try {
            $activite->libelle = $this->libelle;
            $activite->description = $this->description;
            $activite->date_debut = $this->date_debut;
            $activite->date_fin = $this->date_fin;
            $activite->id_projet = $this->id_projet;
            $activite->save();

            return redirect()->Route('activites')->with(
                'success',
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
