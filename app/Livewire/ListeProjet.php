<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Notification;
use App\Models\Projet;
use App\Models\User;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListeProjet extends Component
{

    use WithPagination;

    public $projet;
    public $id;
    public $search;

    public $statut;

    // la fonction pour afficher les projets en fonction de la recherche et de l'utilisateur connecté
    public function s()
    {
    }

    public function confirmDelete($id)
    {
        try {
            // Trouver le projet
            $projet = Projet::findOrFail($id);

            if (!$this->canDeleteProjet($projet)) {
                throw new \Exception('Impossible de supprimer ce projet.');
            }

            // Créer une notification pour la suppression du projet
            $notification = new Notification;
            $notification->user_id = Auth::user()->id;
            $notification->type = "Projet";
            $notification->titre = "Suppression d'une Projet";
            $notification->message = "Le Projet : " . $projet->libelle . " vient d'être supprimé par : " . Auth::user()->email;
            $notification->read = false;
            $notification->save();
            // Supprimer le projet
            $projet->delete();
            return redirect("projets")->with('delete', 'Le projet a été supprimé avec succès');
        } catch (\Exception $e) {
            return redirect("projets")
                ->with('error', 'Impossible de supprimer ce projet  : Vous devez supprimer tous les enregistrements liés à ce projet avant de le supprimer ');
        }
    }

    private function canDeleteProjet($projet)
    {
        // Vérifier s'il existe des relations avec d'autres modèles
        $references = [
            'activite',
            'besoin',
            'rapport',
            'intervenant',
        ];
        foreach ($references as $relation) {
            if ($projet->$relation()->count() > 0) {
                return false;
            }
        }
        return true;
    }





    public function ValidationStatutProjet($id)
    {
        $projet = Projet::find($id);

        if ($this->statut == "en cours") {
            // creer une notification pour la Finition du Projet
            $notification = new Notification;
            // selectionner l'utilisateur qui a valider le Projet
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du Projet)
            $notification->titre = "Démarrage d'un Projet";
            // donner le type de la notification (le statut du Projet)
            $notification->type = "Projet";
            // donner le message de la notification en le concaténant avec le nom du Projet et l'email de l'utilisateur qui a valider le Projet.
            $notification->message = "Le démarrage du Projet : " . $projet->libelle . " viens d'être notifié démarré par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;

            $notification->save();
        } else if ($this->statut == "terminé") {
            // creer une notification pour la Finition du Projet
            $notification = new Notification;
            // selectionner l'utilisateur qui a valider le Projet
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du Projet)
            $notification->titre = "Finition d'un Projet";
            // donner le type de la notification (le statut du Projet)
            $notification->type = "Projet";
            // donner le message de la notification en le concaténant avec le nom du Projet et l'email de l'utilisateur qui a valider le Projet.
            $notification->message = "La finition du Projet : " . $projet->libelle . " viens d'etre valider par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;

            $notification->save();
        } else if ($this->statut == "arrêté") {
            // creer une notification pour la rejet du projet
            $notification = new Notification;
            // selectionner l'utilisateur qui a rejeter le projet
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du projet)
            $notification->titre = "Arrestation de Projet";
            $notification->type = "Projet";
            // donner le message de la notification en le concaténant avec le nom du Projet et l'email de l'utilisateur qui a rejeter le Projet.
            $notification->message = "Le Projet : " . $projet->libelle . " viens d'etre arrêter par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;
            $notification->save();
        }

        // associer le statut du projet
        if ($this->statut != null) {
            $projet->statut = $this->statut;
            if ($projet->statut == "en cours") {
                // Sauvegardez les modifications avec la fonction save()
                $projet->save();
                return redirect("projets")->with('Encours', 'Le Projet est en cours');
            } else if ($projet->statut == "terminé") {
                $projet->save();
                return redirect("projets")->with('terminer', 'Vous venez de notifier la finalisation du projet');
                // Sauvegardez les modifications avec la fonction save() et retourner sur la page des projets
            } else if ($projet->statut == "arrêté") {
                $projet->save();
                return redirect("projets")->with('rejeter', 'Le Projet a été arrêté');
            }
        } else {
            $projet->statut = "en attente";
            // Sauvegardez les modifications avec la fonction save() et retourner sur la page des projets
            $projet->save();
            return redirect("projets")->with('Enattente', 'Le Projet est toujours en cours');
        }

        // retourner sur la page des projets si aucun statut n'est selectionner
        return redirect('projets');
    }


    public function render()
    {
        $projets = Projet::where('libelle', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.liste-projet', compact('projets'));
    }
}
