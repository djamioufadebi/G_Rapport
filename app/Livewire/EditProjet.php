<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Projet;
use Livewire\Component;


class EditProjet extends Component
{
    public $libelle;
    public $description;
    public $date_debut;
    public $date_fin_prevue;
    public $lieu;
    public $statut;
    public $id_client;

    public $projets;
    public function mount()
    {
        $this->libelle = $this->projets->libelle;
        $this->description = $this->projets->description;
        $this->lieu = $this->projets->lieu;
        $this->date_debut = $this->projets->date_debut;
        $this->date_fin_prevue = $this->projets->date_fin_prevue;
        $this->id_client = $this->projets->id_client;
        $this->statut = $this->projets->statut;
    }

    public function update()
    {
        // recherche l'id de l'objet projet et on le prépare pour la modification
        $projet = Projet::find($this->projets->id);

        $this->validate([
            'libelle' => 'string|required',
            'description' => 'string|required',
            'lieu' => 'string|required',
            'date_debut' => 'date|required',
            'date_fin_prevue' => 'date|required',
            'id_client' => 'required',
        ]);

        try {
            $projet->libelle = $this->libelle;
            $projet->description = $this->description;
            $projet->lieu = $this->lieu;
            $projet->date_debut = $this->date_debut;
            $projet->date_fin_prevue = $this->date_fin_prevue;
            $projet->id_client = $this->id_client;
            $projet->save();

            return redirect()->Route('projets')->with(
                'miseajour',
                'Mise à jour du projet !'
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur d\'enregistrement du projet'
            );
        }
    }

    public function render()
    {
        $listeClient = Client::all();
        return view('livewire.edit-projet', compact('listeClient'));
    }
}