<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Projet;
use Livewire\Component;

class CreateActivite extends Component
{
    public $nom;
    public $description;
    public $date_debut;
    public $date_fin;
    public $id_projet;
    public $taux_de_realisation;

    public function store()
    {

        $this->validate([
            'nom' => 'string|required|unique:activites,nom',
            'description' => 'string|required',
            'date_debut' => 'date|required',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'taux_de_realisation' => 'required|numeric|min:0|max:100',
            'id_projet' => 'required',
        ]);
        // pour verifier si l'activité existe déjà
        $query = Activite::where('nom', $this->nom)->get();
        // pour verifier si l'activité existe déjà
        if (count($query) > 0) {
            $this->error = 'Cette activité existe déjà!';
            return redirect()->route('activites.create')->with('dejatiliser', $this->error);
        } else {
            try {
                $activite = new Activite;
                $activite->nom = $this->nom;
                $activite->description = $this->description;
                $activite->date_debut = $this->date_debut;
                $activite->date_fin = $this->date_fin;
                $activite->taux_de_realisation = $this->taux_de_realisation;
                $activite->id_projet = $this->id_projet;
                $activite->save();

                // Réinitialisation des champs
                $this->resetInputFields();
                // réinitialisation des champs
                return redirect()->Route('activites')->with(
                    'success',
                    'Nouvelle Activité ajoutée ! '
                );

            } catch (\Exception $e) {
                return redirect()->back()->with(
                    'error',
                    'Erreur d\'enregistrement de l\'activité '
                );
            }

        }
    }

    // Méthode pour réinitialiser les champs
    private function resetInputFields()
    {
        $this->nom = '';
        $this->description = '';
        $this->date_debut = '';
        $this->date_fin = '';
        $this->id_projet = '';
        $this->taux_de_realisation = '';
    }


    public function render()
    {
        $listeProjet = Projet::all();

        return view('livewire.create-activite', compact('listeProjet'));
    }
}
