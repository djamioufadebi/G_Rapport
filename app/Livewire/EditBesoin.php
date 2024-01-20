<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Besoin;
use App\Models\Projet;
use Auth;
use Livewire\Component;
use App\Models\Notifications;

class EditBesoin extends Component
{

    public $libelle;
    public $contenu;
    public $id_activite;
    public $user_id;


    public $besoins;
    public function mount()
    {
        $this->libelle = $this->besoins->libelle;
        $this->contenu = $this->besoins->contenu;
        $this->id_activite = $this->besoins->id_activite;
        $this->user_id = $this->besoins->user_id;

    }

    public function update()
    {
        // recherche l'id de l'objet besoin et on le prépare pour la modification
        $besoin = Besoin::find($this->besoins->id);

        $this->validate([
            'libelle' => 'string|required',
            'contenu' => 'string|required',
            'id_activite' => 'required',
            'user_id' => '',
        ]);

        try {
            $besoin->libelle = $this->libelle;
            $besoin->contenu = $this->contenu;
            $besoin->id_activite = $this->id_activite;
            $besoin->user_id = Auth::user()->id;
            $besoin->save();

            // recuperer le projet choisi
            $projet = Projet::find($this->id_activite);

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
                'miseajour',
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

        $user = Auth::user();
        $user_id = $user->id;

        // Verifier si le gestionnaire de projet est le même que l'utilisateur
        if ($user->id_profil == 1) {
            // toutes les activités
            $listeActivite = Activite::all();
        } else {
            $projetsUser = Projet::where('id_gestionnaire', '=', $user_id)->get();

            $idsProjetsUser = $projetsUser->pluck('id')->toArray();

            // Récupérer les activités dont le champ 'id_projet' est parmi les IDs extraits
            $listeActivite = Activite::whereIn('id_projet', $idsProjetsUser)->get();
        }


        return view('livewire.edit-besoin', compact('listeActivite'));
    }
}
