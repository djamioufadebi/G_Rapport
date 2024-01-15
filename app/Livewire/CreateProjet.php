<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Client;
use App\Models\Projet;
use Livewire\Component;

class CreateProjet extends Component
{
    public $libelle;
    public $description;
    public $date_debut;
    public $date_fin_prevue;

    public $lieu;

    public $projet;
    public $id_user;
    public $id_client;

    public $statut;

    protected $paginationTheme = "bootstrap";


    public function store()
    {

        $client = Client::findOrFail($this->id_client);

        $this->validate([
            'libelle' => 'string|required|unique:projets,libelle',
            'description' => 'string|required',
            'lieu' => 'string|required',
            'date_debut' => 'date|required',
            'date_fin_prevue' => 'date|required',
            'statut' => 'string',
            'id_user' => '',
            'id_client' => 'required',

        ]);

        // pour verifier si le Projet existe déjà
        $query = Projet::where('libelle', $this->libelle)->get();
        // pour verifier si Projet existe déjà
        if (count($query) > 0) {

            $message = 'Ce Projet existe déjà!';
            return redirect()->route('projets.create')->with('dejautiliser', $message);
        } else {

            try {
                $projet = new Projet;
                $projet->libelle = $this->libelle;
                $projet->description = $this->description;
                $projet->lieu = $this->lieu;
                $projet->date_debut = $this->date_debut;
                $projet->date_fin_prevue = $this->date_fin_prevue;
                $projet->statut = $this->statut;
                $projet->id_client = $this->id_client;
                // pour recuperer le User connecté
                $projet->id_user = auth()->user()->id;

                $projet->save();

                return redirect()->Route('projets')->with(
                    'success',
                    'Nouveau projet ajoutée ! '
                );
            } catch (\Exception $e) {
                return redirect()->back()->with(
                    'error',
                    'Erreur d\'enregistrement du projet '
                );
            }
        }
    }
    public function render()
    {
        $currentClient = Client::all();
        return view('livewire.create-projet', compact('currentClient'));
    }
}