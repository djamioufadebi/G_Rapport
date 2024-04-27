<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Notification;
use App\Models\Projet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListeActivite extends Component
{
    public $statut;
    public $date_debut;
    public $date_fin;
    public $search;

    use WithPagination;

    // Le code pour spécifier qu'on veut utiliser le theme de bootstrap pour la pagination
    protected $paginationTheme = 'bootstrap';

    public function s()
    {
    }

    public function confirmDelete($id)
    {
        // verifier si l'utilisateur connecté est autorisé à supprimer cette activité
        //$user = Auth::user();
        // if ($user->id_profil == 1) {
        //  try {
        $activite = Activite::find($id);
        //    if (!$this->canDeleteActivite($activite)) {
        //        throw new \Exception('Impossible de supprimer cette activité.');
        //    }
        // creer une notification pour la suppresion du activite
        $notification = new Notification;
        // selectionner l'utilisateur qui a supprimer le activite
        $notification->user_id = Auth::user()->id;
        // donner le titre de la notification
        $notification->titre = "Suppression d'une activite";
        // le type du message de la notification est l'activite
        $notification->type = "Activité";
        // donner le message de la notification en le concaténant avec le nom du activite et l'email de l'utilisateur qui a supprimer le activite.
        $notification->message = "L'activite : " . $activite->libelle . " viens d'etre supprimer par :" . Auth::user()->email;
        $notification->read = false;

        $notification->save();

        //  selectionner le activite à supprimer avec la fonction find() et le supprimer avec la fonction delete()
        $activite->delete();
        return redirect("activites")->with('delete', 'L\'activité a été supprimé');

        //} catch (\Exception $e) {
        //    return redirect("activites")
        //         ->with('error', 'Impossible de supprimer cette activité : Vous devez supprimer tous les enregistrements liés à cette activité avant de le supprimer ');
        //  }

        // } else {
        //    return view('composants.acces_refuser');
        //}



    }

    private function canDeleteActivite($activite)
    {
        // Vérifier s'il existe des relations avec d'autres modèles
        $references = [
            'activite',
            'besoin',
            'rapport',
            'intervenant',
            'bilan',
        ];
        foreach ($references as $relation) {
            if ($activite->$relation()->count() > 0) {
                return false;
            }
        }
        return true;
    }

    // les fonctions pour gérer le statut de l'activité (en cours, terminé, arrêté, en attente) en fonction des dates de début et de fin

    protected $rules = [
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
    ];

    public function ValidationStatutActivite($id)
    {
        $activite = Activite::find($id);

        $this->createNotification($activite);

        // Associer le statut de l'activite
        if ($this->statut != null && $this->date_debut != null && $this->date_fin != null) {
            $activite->statut = $this->statut;
            $activite->date_debut = $this->date_debut;
            $activite->date_fin = $this->date_fin;

            if ($activite->statut == "en cours") {
                $this->rules['date_debut'] = 'required|date|before_or_equal:' . now()->toDateString();
                $activite->statut = $this->statut;
                $activite->date_debut = $this->date_debut;
                $activite->date_fin = $this->date_fin;
                $activite->save();
                return redirect("activites")->with('En cours', 'L\'activite vient de démarrer');
            } elseif ($activite->statut == "terminé") {
                $this->rules['date_fin'] = 'required|date|before_or_equal:' . now()->toDateString();
                $activite->statut = $this->statut;
                $activite->date_debut = $this->date_debut;
                $activite->date_fin = $this->date_fin;
                $activite->save();
                return redirect("activites")->with('terminer', 'Vous venez de notifier la finalisation de l\'activité');
            } elseif ($activite->statut == "arrêté") {
                $this->rules['date_debut'] = 'required|date|before:' . now()->toDateString();
                $this->rules['date_fin'] = 'required|date|after:' . now()->toDateString();
                $activite->statut = $this->statut;
                $activite->date_debut = $this->date_debut;
                $activite->date_fin = $this->date_fin;
                $activite->save();
                return redirect("activites")->with('rejeter', 'Le activite a été arrêté');
            } elseif ($activite->statut == "en attente") {
                $this->rules['date_debut'] = 'required|date|after:' . now()->toDateString();
                $activite->statut = $this->statut;
                $activite->date_debut = $this->date_debut;
                $activite->date_fin = $this->date_fin;
                $activite->save();
                return redirect("activites")->with('Enattente', 'L\'activite est toujours en attente');
            }
        }
        $this->validateOnly('date_debut');
        $this->validateOnly('date_fin');
    }

    protected function createNotification($activite)
    {
        $notification = new Notification;
        $notification->user_id = Auth::user()->id;
        $notification->read = false;
        $notification->type = "Activité";

        switch ($this->statut) {
            case 'en cours':
                $notification->titre = "Validation d'une activite";
                $notification->message = "Le démarrage de l'activite : " . $activite->libelle . " vient d'être confirmé par :" . Auth::user()->email;
                break;
            case 'terminé':
                $notification->titre = "Finition d'un activite";
                $notification->message = "La finition de l'activite : " . $activite->libelle . " vient d'etre validée par :" . Auth::user()->email;
                break;
            case 'arrêté':
                $notification->titre = "Arrêt d'une activite";
                $notification->message = "L'activite : " . $activite->libelle . " vient d'etre arrêtée par :" . Auth::user()->email;
                break;
            case 'en attente':
                $notification->titre = "Mise en attente d'une activite";
                $notification->message = "L'activite : " . $activite->libelle . " est mise en attente par :" . Auth::user()->email;
                break;
            default:
                // Gérer le cas par défaut ou ne rien faire
                break;
        }

        $notification->save();
    }


    public function render()
    {
        $word = '%' . $this->search . '%';
        $listeActivites = Activite::where('nom', 'like', $word)
        ->orWhere('description','like', $word)
        ->orWhere('lieu','like', $word)
            ->paginate(5);

        $user = Auth::user();
        $user_id = Auth::user()->id;

        // Verifier si le gestionnaire de projet est le même que l'utilisateur
        if ($user->id_profil == 1) {
            // toutes les activités
            $listeActivites = Activite::latest()->paginate(10);
        } else {
            // Récupérer les projets de l'utilisateur
            $projetsUser = Projet::where('id_gestionnaire', '=', $user_id)->get();
            // Extraire uniquement les IDs des projets
            $idsProjetsUser = $projetsUser->pluck('id')->toArray();
            // Récupérer les activités dont le champ 'id_projet' est parmi les IDs extraits
            $listeActivites = Activite::whereIn('id_projet', $idsProjetsUser)->latest()->paginate(10);
        }

        return view('livewire.liste-activite', compact('listeActivites'));
    }
}