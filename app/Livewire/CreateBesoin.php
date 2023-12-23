<?php

namespace App\Livewire;

use App\Models\Besoin;
use App\Models\Projet;
use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class CreateBesoin extends Component
{

    public $libelle;
    public $contenu;
    public $id_projet;

    public function store()
    {

        $this->validate([
            'libelle' => 'string|required|unique:besoins,libelle',
            'contenu' => 'string|required',
            'id_projet' => 'required',

        ]);

        // pour verifier si le besoin existe déjà
        $query = Besoin::where('libelle', $this->libelle)->get();
        // pour verifier si besoin existe déjà
        if (count($query) > 0) {

            $this->error = 'Ce Besoin existe déjà!';
            return redirect()->route('besoins.create')->with('dejatiliser', $this->error);
        } else {

            try {
                $besoin = new Besoin;
                $besoin->libelle = $this->libelle;
                $besoin->contenu = $this->contenu;
                $besoin->id_projet = $this->id_projet;

                // recuperer le projet choisi
                $projet = Projet::find($this->id_projet);

                // creer une notification pour la creation du besoin
                $notification = new Notification;
                $notification->user_id = Auth::user()->id;
                $notification->titre = "Creation d'un besoin";
                $notification->message = "Le besoin : " . $this->libelle . " viens d'etre creer pour le projet :" . $projet->libelle;
                $notification->read = false;

                $besoin->save();
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

        $listeProjet = Projet::all();

        return view('livewire.create-besoin', compact('listeProjet'));
    }
}
