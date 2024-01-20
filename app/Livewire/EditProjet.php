<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Projet;
use App\Models\User;
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
    public $id_gestionnaire;

    public $projets;
    public function mount()
    {
        $this->libelle = $this->projets->libelle;
        $this->description = $this->projets->description;
        $this->lieu = $this->projets->lieu;
        $this->date_debut = $this->projets->date_debut;
        $this->date_fin_prevue = $this->projets->date_fin_prevue;
        $this->id_client = $this->projets->id_client;
        $this->id_gestionnaire = $this->projets->id_gestionnaire;
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
            'statut' => 'string',
            'id_client' => 'required',
            'id_gestionnaire' => 'required'
        ]);

        try {
            $projet->libelle = $this->libelle;
            $projet->description = $this->description;
            $projet->lieu = $this->lieu;
            $projet->date_debut = $this->date_debut;
            $projet->date_fin_prevue = $this->date_fin_prevue;
            $projet->statut = $this->statut;
            $projet->id_client = $this->id_client;
            $projet->id_gestionnaire = $this->id_gestionnaire;
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
        // sélectionner les utilisateur qui on le profil gestionnaire
        $managers = User::where('id_profil', '=', '2')->get();
        return view('livewire.edit-projet', compact('listeClient', 'managers'));
    }
}
