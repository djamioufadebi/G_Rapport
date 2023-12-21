<?php

namespace App\Livewire;

use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class CreateRapport extends Component
{

    public $libelle;
    public $contenu;
    public $id_projet;

    public $rapport;

    public function store()
    {
        $this->validate([
            'libelle' => 'string|required|unique:rapports,libelle',
            'contenu' => 'string|required',
            'id_projet' => 'required',
        ]);

        try {
            $rapport = new Rapport();
            $rapport->libelle = $this->libelle;
            $rapport->contenu = $this->contenu;
            $rapport->id_projet = $this->id_projet;

            // recuperer le projet choisi
            $projet = Projet::find($this->id_projet);

            // creer une notification pour la creation du rapport
            $notification = new Notification;
            $notification->user_id = Auth::user()->id;
            $notification->titre = "Creation d'un rapport";
            $notification->message = "Le rapport : ".$this->libelle." viens d'etre creer pour le projet :".$projet->libelle;
            $notification->read = false;

            $notification->save();
            $rapport->save();

            return redirect()->Route('rapports')->with(
                'success',
                'Nouveau rapport ajoutée !'
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

        return view('livewire.create-rapport', compact('listeProjet'));
    }
}