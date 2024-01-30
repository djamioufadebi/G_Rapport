<?php

namespace App\Livewire;

use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use App\Models\Activite;


class CreateRapport extends Component
{

    public $libelle;
    public $travaux_prevus_journee;

    public $travaux_realises;

    public $travaux_restants;

    public $travaux_prevus_demain;

    public $besoins_materiaux;

    public $heure_demarrage;

    public $heure_fin;
    public $materiels_utilises;
    public $difficultes_rencontrees;
    public $solutions_apportees;
    public $id_activite;
    public $user_id;
    public $rapport;

    public function store()
    {

        $this->validate([
            'libelle' => 'string|required|unique:rapports,libelle',
            'materiels_utilises' => 'string|required',
            'difficultes_rencontrees' => 'string|required',
            'solutions_apportees' => 'string|required',
            'heure_demarrage' => 'string|required',
            'heure_fin' => 'string|required',
            'travaux_prevus_journee' => 'string|required',
            'travaux_realises' => 'string|required',
            'travaux_restants' => 'string|required',
            'travaux_prevus_demain' => 'string|required',
            'besoins_materiaux' => 'string|required',
            'id_activite' => 'required',
            'user_id' => '',
        ]);

        // pour verifier si le Rapport existe déjà
        $query = Rapport::where('libelle', $this->libelle)->get();
        //  pour verifier si Rapport existe déjà
        if (count($query) > 0) {
            $message = 'Ce Rapport existe déjà!';
            return redirect()->route('rapports.create')->with('dejautiliser', $message);
        } else {

            try {
                $rapport = new Rapport();
                $rapport->id_activite = $this->id_activite;
                $rapport->libelle = $this->libelle;
                $rapport->materiels_utilises = $this->materiels_utilises;
                $rapport->difficultes_rencontrees = $this->difficultes_rencontrees;
                $rapport->solutions_apportees = $this->solutions_apportees;
                $rapport->travaux_prevus_journee = $this->travaux_prevus_journee;
                $rapport->travaux_realises = $this->travaux_realises;
                $rapport->travaux_restants = $this->travaux_restants;
                $rapport->travaux_prevus_demain = $this->travaux_prevus_demain;
                $rapport->besoins_materiaux = $this->besoins_materiaux;
                $rapport->heure_demarrage = $this->heure_demarrage;
                $rapport->heure_fin = $this->heure_fin;
                $rapport->user_id = Auth::user()->id;
                //  on enregistre le Rapport
                $rapport->save();
                // recuperer le Activte$Activte choisi
                $activite = Activite::find($this->id_activite);

                //creer une notification pour la creation du rapport
                $notification = new Notifications;
                $notification->rapport_id = $rapport->id;
                $notification->user_id = Auth::user()->id;
                $notification->type = "rapport";
                $notification->titre = "Creation d'un rapport";
                $notification->message = "Le rapport : " . $this->libelle . " viens d'etre creer pour l'activité :" . $activite->nom;
                $notification->read = false;
                $notification->save();
                return redirect()->Route('rapports')->with(
                    'success',
                    'Nouveau rapport ajoutée !'
                );
            } catch (\Exception $e) {
                dd($e);
                return redirect()->back()->with(
                    'error',
                    'Erreur d\'enregistrement du rapport'
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


        return view('livewire.create-rapport', compact('listeActivite'));
    }
}