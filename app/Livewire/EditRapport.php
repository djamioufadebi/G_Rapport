<?php

namespace App\Livewire;

use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class EditRapport extends Component
{
    public $libelle;
    public $contenu;
    public $id_projet;

    public $rapports;
    public function mount()
    {
        $this->libelle = $this->rapports->libelle;
        $this->contenu = $this->rapports->contenu;
        $this->id_projet = $this->rapports->id_projet;
    }

    public function update()
    {
        // recherche l'id de l'objet rapport et on le prépare pour la modification
        $rapport = Rapport::find($this->rapports->id);

        $this->validate([
            'libelle' => 'string|required|unique:rapports,libelle',
            'contenu' => 'string|required',
            'id_projet' => 'required',
        ]);

        try {
            $rapport->libelle = $this->libelle;
            $rapport->contenu = $this->contenu;
            $rapport->id_projet = $this->id_projet;
            $rapport->save();

            // recuperer le projet choisi
            $projet = Projet::find($this->id_projet);

            // creer une notification pour la creation du rapport
            $notification = new Notifications;
            $notification->rapport_id = $rapport->id;
            $notification->user_id = Auth::user()->id;
            $notification->type = "rapport";
            $notification->titre = "Mise a jour d'un rapport";
            $notification->message = "Le rapport : " . $this->libelle . " viens d'etre mis a jour pour le projet :" . $projet->libelle;
            $notification->read = false;

            $notification->save();

            return redirect()->Route('rapports')->with(
                'success',
                'Mise à jour du rapport !'
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur d\'enregistrement du rapport'
            );
        }
    }
    public function render()
    {
        $listeProjet = Projet::all();
        return view('livewire.edit-rapport', compact('listeProjet'));
    }
}
