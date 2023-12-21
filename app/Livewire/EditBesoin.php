<?php

namespace App\Livewire;

use App\Models\Besoin;
use App\Models\Projet;
use Livewire\Component;

class EditBesoin extends Component
{

    public $libelle;
    public $contenu;
    public $id_projet;

    public $besoins;
    public function mount()
    {
        $this->libelle = $this->besoins->libelle;
        $this->contenu = $this->besoins->contenu;
        $this->id_projet = $this->besoins->id_projet;

    }

    public function update()
    {
        // recherche l'id de l'objet besoin et on le prépare pour la modification
        $besoin = Besoin::find($this->besoins->id);

        $this->validate([
            'libelle' => 'string|required|unique:besoins,libelle',
            'contenu' => 'string|required',
            'id_projet' => 'required',
        ]);

        try {
            $besoin->libelle = $this->libelle;
            $besoin->contenu = $this->contenu;
            $besoin->id_projet = $this->id_projet;
            $besoin->save();

            return redirect()->Route('besoins')->with(
                'success',
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
        $listeProjet = Projet::all();
        return view('livewire.edit-besoin', compact('listeProjet'));
    }
}