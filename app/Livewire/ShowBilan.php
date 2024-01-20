<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use App\Models\Rapport;
use Auth;
use Livewire\Component;

class ShowBilan extends Component
{
    public $projets;
    public $activite;
    public function mount()
    {
        $this->projets = Projet::all();
    }

    // recupérer l'activité en cours selectionnée
    public function getActivite()
    {
        $activite = Activite::find($this->id_activite);
        $rapport = Rapport::where('id_activite', $activite->id)->first();
        dd($rapport);
        return $rapport;
    }

    // recuperer l'activité selectionnée par l'utilisateur
    public function getActiviteId()
    {
        $activite = Activite::find($this->id);
        return $activite->id;
    }



    public function render()
    {

        $user = Auth::user();
        $user_id = Auth::user()->id;

        // Verifier si le gestionnaire de projet est le même que l'utilisateur
        if ($user->id_profil == 1) {
            // toutes les activités
            $projets = Projet::all();
        } else {
            $projets = Projet::where('id_gestionnaire', '=', $user_id)->get();
        }


        // Verifier si le gestionnaire de projet est le même que l'utilisateur
        if ($user->id_profil == 1) {
            // toutes les activités
            $activites = Activite::all();
        } else {
            // Récupérer les projets de l'utilisateur
            $projetsUser = Projet::where('id_gestionnaire', '=', $user_id)->get();
            // Extraire uniquement les IDs des projets
            $idsProjetsUser = $projetsUser->pluck('id')->toArray();
            // Récupérer les activités dont le champ 'id_projet' est parmi les IDs extraits
            $activites = Activite::whereIn('id_projet', $idsProjetsUser)->get();

        }




        return view('livewire.show-bilan', compact('projets', 'activites'));
    }

}
