<?php

namespace App\Livewire;

use App\Models\Besoin;
use App\Models\Projet;
use Livewire\Component;
use App\Models\Notifications;

class EditBesoin extends Component
{

    public $libelle;
    public $contenu;
    public $id_projet;

    public $besoins;
    public function mount()
    {
        $this->libelle = $this->besoins->libelle;
        $this->contenu = $this->besoins->contenu;
        $this->id_projet = $this->besoins->id_projet;

    }

    public function update()
    {
        // recherche l'id de l'objet besoin et on le prépare pour la modification
        $besoin = Besoin::find($this->besoins->id);

        $this->validate([
            'libelle' => 'string|required|unique:besoins,libelle',
            'contenu' => 'string|required',
            'id_projet' => 'required',
        ]);

        try {
            $besoin->libelle = $this->libelle;
            $besoin->contenu = $this->contenu;
            $besoin->id_projet = $this->id_projet;
            $besoin->save();

            // recuperer le projet choisi
            $projet = Projet::find($this->id_projet);

            // creer une notification pour la creation du rapport
            $notification = new Notifications;
            $notification->besoin_id = $besoin->id;
            $notification->type = "besoin";
            $notification->user_id = Auth::user()->id;
            $notification->titre = "Mise a jour d'un besoin";
            $notification->message = "Le besoin : " . $this->libelle . " viens d'etre mis a jour pour le projet :" . $projet->libelle;
            $notification->read = false;

            $notification->save();

            return redirect()->Route('besoins')->with(
                'success',
                'Mise à jour du besoin !'
            );
        } catch (\Exception $e) {
            return redirect()->back()->with(
                'error',
                'Erreur d\'enregistrement du besoin'
            );
        }
    }
    public function render()
    {
        $listeProjet = Projet::all();
        return view('livewire.edit-besoin', compact('listeProjet'));
    }
}