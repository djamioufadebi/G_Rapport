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
    public $contenu;
    public $id_activite;
    public $taux_de_realisation;
    public $materiels_utilises;
    public $difficultes_rencontrees;
    public $solutions_apportees;

    public $rapports;
    public function mount()
    {
        $this->libelle = $this->rapports->libelle;
        $this->contenu = $this->rapports->contenu;
        $this->id_activite = $this->rapports->id_activite;
        $this->taux_de_realisation = $this->rapports->taux_de_realisation;
        $this->materiels_utilises = $this->rapports->materiels_utilises;
        $this->difficultes_rencontrees = $this->rapports->difficultes_rencontrees;
        $this->solutions_apportees = $this->rapports->solutions_apportees;
    }

    public function update()
    {
        // recherche l'id de l'objet rapport et on le prépare pour la modification
        $rapport = Rapport::find($this->rapports->id);

        $this->validate([
            'libelle' => 'string|required',
            'contenu' => 'string|required',
            'taux_de_realisation' => 'required|numeric|min:0|max:100',
            'materiels_utilises' => 'string|required',
            'difficultes_rencontrees' => 'string|required',
            'solutions_apportees' => 'string|required',
            'id_activite' => 'required',
        ]);

        try {
            $rapport->libelle = $this->libelle;
            $rapport->contenu = $this->contenu;
            $rapport->id_activite = $this->id_activite;
            $rapport->taux_de_realisation = $this->taux_de_realisation;
            $rapport->materiels_utilises = $this->materiels_utilises;
            $rapport->difficultes_rencontrees = $this->difficultes_rencontrees;
            $rapport->solutions_apportees = $this->solutions_apportees;
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
