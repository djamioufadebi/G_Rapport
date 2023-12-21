<?php

namespace App\Livewire;

use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;

class EditRapport extends Component
{
    public $libelle;
    public $contenu;
    public $id_projet;

    public $rapports;
    public function mount()
    {
        $this->libelle = $this->rapports->libelle;
        $this->contenu = $this->rapports->contenu;
        $this->id_projet = $this->rapports->id_projet;
    }

    public function update()
    {
        // recherche l'id de l'objet rapport et on le prépare pour la modification
        $rapport = Rapport::find($this->rapports->id);

        $this->validate([
            'libelle' => 'string|required|unique:rapports,libelle',
            'contenu' => 'string|required',
            'id_projet' => 'required',
        ]);

        try {
            $rapport->libelle = $this->libelle;
            $rapport->contenu = $this->contenu;
            $rapport->id_projet = $this->id_projet;
            $rapport->save();

            return redirect()->Route('rapports')->with(
                'success',
                'Mise à jour du rapport !'
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
        return view('livewire.edit-rapport', compact('listeProjet'));
    }
}
