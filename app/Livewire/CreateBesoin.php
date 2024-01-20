<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Besoin;
use App\Models\Projet;
use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class CreateBesoin extends Component
{

    public $libelle;
    public $contenu;
    public $id_activite;
    public $user_id;

    public function store()
    {

        $this->validate([
            'libelle' => 'string|required|unique:besoins,libelle',
            'contenu' => 'string|required',
            'id_activite' => 'required',
            'user_id' => '',
        ]);

        // pour verifier si le besoin existe déjà
        $query = Besoin::where('libelle', '=', $this->libelle)->get();
        // pour verifier si besoin existe déjà
        if (count($query) > 0) {
            $message = 'Ce Besoin existe déjà!';
            return redirect()->route('besoins.create')->with('dejautiliser', $message);
        } else {
            try {
                $besoin = new Besoin;
                $besoin->libelle = $this->libelle;
                $besoin->contenu = $this->contenu;
                $besoin->id_activite = $this->id_activite;
                $besoin->user_id = Auth::user()->id;
                $besoin->save();

                // recuperer le activite choisi
                $activite = Activite::find($this->id_activite);

                // creer une notification pour la creation du rapport
                $notification = new Notifications;
                $notification->besoin_id = $besoin->id;
                $notification->type = "besoin";
                $notification->user_id = Auth::user()->id;
                $notification->titre = "Creation d'un besoin";
                $notification->message = "Le besoin : " . $this->libelle . " viens d'etre creer pour l'activite :" . $activite->nom;
                $notification->read = false;

                $notification->save();

                return redirect()->Route('besoins')->with(
                    'success',
                    'Nouveau Besoin ajoutée !'
                );
            } catch (\Exception $e) {
                return redirect()->back()->with(
                    'error',
                    'Erreur d\'enregistrement du Besoin'
                );
            }
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

        return view('livewire.create-besoin', compact('listeActivite'));
    }
}
