<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Besoin;
use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class CreateBesoin extends Component
{

    public $libelle;
    public $contenu;
    public $id_activite;

    public function store()
    {

        $this->validate([
            'libelle' => 'string|required|unique:besoins,libelle',
            'contenu' => 'string|required',
            'id_activite' => 'required',

        ]);

        // pour verifier si le besoin existe déjà
        $query = Besoin::where('libelle', $this->libelle)->get();
        // pour verifier si besoin existe déjà
        if (count($query) > 0) {

            $message = 'Ce Besoin existe déjà!';
            return redirect()->route('besoins.create')->with('dejautiliser', $message);
        } else {

            try {
                $besoin = new Besoin;
                $besoin->libelle = $this->libelle;
                $besoin->user_id = Auth::user()->id;
                $besoin->contenu = $this->contenu;
                $besoin->id_activite = $this->id_activite;

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

        $listeActivite = Activite::all();

        return view('livewire.create-besoin', compact('listeActivite'));
    }
}