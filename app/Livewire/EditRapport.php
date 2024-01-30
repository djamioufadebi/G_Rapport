<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class EditRapport extends Component
{
    public $libelle;
    public $travaux_prevus_journee;

    public $travaux_realises;

    public $travaux_restants;

    public $travaux_prevus_demain;

    public $besoins_materiaux;

    public $heure_demarrage;

    public $heure_fin;
    public $id_activite;
    public $materiels_utilises;
    public $difficultes_rencontrees;
    public $solutions_apportees;
    public $statut;

    public $rapports;
    public function mount()
    {
        $this->libelle = $this->rapports->libelle;
        $this->travaux_prevus_journee = $this->rapports->travaux_prevus_journee;
        $this->travaux_realises = $this->rapports->travaux_realises;
        $this->travaux_restants = $this->rapports->travaux_restants;
        $this->travaux_prevus_demain = $this->rapports->travaux_prevus_demain;
        $this->besoins_materiaux = $this->rapports->besoins_materiaux;
        $this->heure_demarrage = $this->rapports->heure_demarrage;
        $this->heure_fin = $this->rapports->heure_fin;
        $this->id_activite = $this->rapports->id_activite;
        $this->materiels_utilises = $this->rapports->materiels_utilises;
        $this->difficultes_rencontrees = $this->rapports->difficultes_rencontrees;
        $this->solutions_apportees = $this->rapports->solutions_apportees;
        $this->statut = $this->rapports->statut;
    }

    public function update()
    {
        // recherche l'id de l'objet rapport et on le prépare pour la modification
        $rapport = Rapport::find($this->rapports->id);

        $this->validate([
            'libelle' => 'string|required',
            'materiels_utilises' => 'string|required',
            'difficultes_rencontrees' => 'string|required',
            'solutions_apportees' => 'string|required',
            'heure_demarrage' => 'string|required',
            'heure_fin' => 'string|required',
            'besoins_materiaux' => 'string|required',
            'travaux_prevus_journee' => 'string|required',
            'travaux_realises' => 'string|required',
            'travaux_restants' => 'string|required',
            'travaux_prevus_demain' => 'string|required',
            'id_activite' => 'required',
        ]);

        try {
            $rapport->libelle = $this->libelle;
            $rapport->id_activite = $this->id_activite;
            $rapport->materiels_utilises = $this->materiels_utilises;
            $rapport->difficultes_rencontrees = $this->difficultes_rencontrees;
            $rapport->solutions_apportees = $this->solutions_apportees;
            $rapport->heure_demarrage = $this->heure_demarrage;
            $rapport->heure_fin = $this->heure_fin;
            $rapport->besoins_materiaux = $this->besoins_materiaux;
            $rapport->travaux_prevus_journee = $this->travaux_prevus_journee;
            $rapport->travaux_realises = $this->travaux_realises;
            $rapport->travaux_restants = $this->travaux_restants;
            $rapport->travaux_prevus_demain = $this->travaux_prevus_demain;
            $rapport->save();

            // recuperer le projet choisi
            $activte = Activite::find($this->id_activite);

            // creer une notification pour la creation du rapport
            $notification = new Notifications;
            $notification->rapport_id = $rapport->id;
            $notification->user_id = Auth::user()->id;
            $notification->type = "rapport";
            $notification->titre = "Mise a jour d'un rapport";
            $notification->message = "Le rapport : " . $this->libelle . " viens d'etre mis a jour pour l'activté :" . $activte->libelle;
            $notification->read = false;

            $notification->save();

            return redirect()->Route('rapports')->with(
                'miseajour',
                'Mise à jour du rapport !'
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'errormiseajour',
                'Erreur d\'enregistrement du rapport'
            );
        }
    }
    public function render()
    {
        $listeActivite = Activite::all();
        return view('livewire.edit-rapport', compact('listeActivite'));
    }
}
