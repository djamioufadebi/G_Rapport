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
    public $date_debut;
    public $date_fin_prevue;

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


    // les fonctios pour gerer les conditons des dates en fonction du statut
    public function handleDateDebutChange()
    {
        // Appliquer des conditions en fonction du statut et de la date de début
        if ($this->statut == 'en attente') {
            // Empêcher la sélection d'une date de début inférieure à la date du jour
            $this->date_debut = max($this->date_debut, now()->toDateString()); // Met à jour la date de début à la date du jour si elle est inférieure
        } elseif ($this->statut == 'en cours') {
            // La date de début doit être inférieure ou égale à la date du jour
            $this->date_debut = max($this->date_debut, now()->toDateString()); // Met à jour la date de début à la date du jour si elle est inférieure
        } elseif ($this->statut == 'terminé') {
            // Ne pas permettre de changer la date de début une fois qu'elle est définie pour le statut "terminé"
            $this->date_debut = now()->toDateString(); // Met à jour la date de début à la date du jour
        }
    }

    public function handleDateFinPrevueChange()
    {
        // Appliquer des conditions en fonction du statut et de la date de fin prévue
        if ($this->statut == 'en attente') {
            // Logique pour le statut "en attente"
            // Par exemple, vous pourriez empêcher l'utilisateur de sélectionner une date de fin inférieure à la date du jour
            $this->date_fin_prevue = max($this->date_fin_prevue, now()->toDateString()); // Met à jour la date de fin à la date du jour si elle est inférieure
        } elseif ($this->statut == 'en cours') {
            // Logique pour le statut "en cours"
            // Par exemple, assurez-vous que la date de fin est supérieure à la date du jour
            $this->date_fin_prevue = max($this->date_fin_prevue, now()->toDateString()); // Met à jour la date de fin à la date du jour si elle est inférieure
        } elseif ($this->statut == 'terminé') {
            // Logique pour le statut "terminé"
            // Par exemple, vous pourriez empêcher l'utilisateur de changer la date de fin une fois qu'elle est définie
        }
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
        } else if ($this->statut == "en attente") {
            $notification = new Notification;
            // selectionner l'utilisateur qui a rejeter le projet
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du projet)
            $notification->titre = "Mise en attente de Projet";
            $notification->type = "Projet";
            // donner le message de la notification en le concaténant avec le nom du Projet et l'email de l'utilisateur qui a rejeter le Projet.
            $notification->message = "Le Projet : " . $projet->libelle . " est mise en attente par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;
            $notification->save();
        }

        // associer le statut du projet
        if ($this->statut != null && $this->date_debut != null && $this->date_fin_prevue != null) {
            $projet->statut = $this->statut;
            $projet->date_debut = $this->date_debut;
            $projet->date_fin_prevue = $this->date_fin_prevue;

            if ($projet->statut == "en cours") {

                // Met à jour la date de début à la date du jour si elle est inférieure
                $this->date_debut = now()->toDateString();

                // Assurez-vous que la date de fin est supérieure ou égale à la date de début
                $this->date_fin_prevue = max($this->date_debut, $this->date_fin_prevue);

                // Sauvegardez les modifications avec la fonction save()
                $projet->save();
                return redirect("projets")->with('Encours', 'Le Projet est en cours');

            } else if ($projet->statut == "terminé") {

                // Met à jour la date de fin à la date du jour si elle est inférieure à la date de début
                $this->date_fin_prevue = now()->toDateString();
                $this->date_debut = null;
                $projet->save();
                return redirect("projets")->with('terminer', 'Vous venez de notifier la finalisation du projet');
                // Sauvegardez les modifications avec la fonction save() et retourner sur la page des projets
            } else if ($projet->statut == "arrêté") {
                // La date de fin doit être égale à la date du jour
                $this->date_fin_prevue = now()->toDateString(); // Met à jour la date de fin à la date du jour
                // Réinitialise la date de début
                $this->date_debut = null;
                $projet->save();
                return redirect("projets")->with('arreter', 'Le Projet a été arrêté');
            }
        } else if ($projet->statut == "en attente") {
            // Empêcher la sélection d'une date de début inférieure à la date du jour
            $this->date_debut = now()->toDateString(); // Met à jour la date de début à la date du jour si elle est inférieure
            $this->date_fin_prevue = null; // Réinitialise la date de fin prévue
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
