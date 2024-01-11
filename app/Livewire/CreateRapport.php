<?php

namespace App\Livewire;

use App\Models\Rapport;
use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use App\Models\Activite;


class CreateRapport extends Component
{

    public $libelle;
    public $contenu;
    public $taux_de_realisation;
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
            'contenu' => 'string|required',
            'taux_de_realisation' => 'required|numeric|min:0|max:100',
            'materiels_utilises' => 'string|required',
            'difficultes_rencontrees' => 'string|required',
            'solutions_apportees' => 'string|required',
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
                $rapport->libelle = $this->libelle;
                $rapport->contenu = $this->contenu;
                $rapport->taux_de_realisation = $this->taux_de_realisation;
                $rapport->materiels_utilises = $this->materiels_utilises;
                $rapport->difficultes_rencontrees = $this->difficultes_rencontrees;
                $rapport->solutions_apportees = $this->solutions_apportees;
                $rapport->id_activite = $this->id_activite;
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

        $listeActivite = Activite::all();

        return view('livewire.create-rapport', compact('listeActivite'));
    }
}
