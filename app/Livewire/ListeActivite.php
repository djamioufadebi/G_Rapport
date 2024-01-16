<?php

namespace App\Livewire;

use App\Models\Activite;
use App\Models\Notification;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListeActivite extends Component
{
    public $statut;
    public $date_debut;
    public $date_fin;
    public $search;

    use WithPagination;

    public function s()
    {
    }

    public function confirmDelete($id)
    {
        try {
            $activite = Activite::find($id);
            if (!$this->canDeleteActivite($activite)) {
                throw new \Exception('Impossible de supprimer cette activité.');
            }

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

        } catch (\Exception $e) {
            return redirect("activites")
                ->with('error', 'Impossible de supprimer cette activité : Vous devez supprimer tous les enregistrements liés à cette activité avant de le supprimer ');
        }
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

    public function ValidationStatutActivite($id)
    {
        $activite = Activite::find($id);

        if ($this->statut == "en cours") {
            // creer une notification pour la validation du activite
            $notification = new Notification;
            // selectionner l'utilisateur qui a valider le activite
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du activite)
            $notification->titre = "Validation d'une activite";
            $notification->type = "Activité";
            // donner le message de la notification en le concaténant avec le nom du activite et l'email de l'utilisateur qui a valider le activite
            $notification->message = "Le démarrage de l'activite : " . $activite->libelle . " viens d'être comfirmé par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;
            $notification->save();
        } else if ($this->statut == "terminé") {
            // creer une notification pour la Finition du activite
            $notification = new Notification;
            // selectionner l'utilisateur qui a valider le activite
            $notification->user_id = Auth::user()->id;
            $notification->type = "Activité";
            // donner le titre de la notification (le statut du activite)
            $notification->titre = "Finition d'un activite";
            // donner le message de la notification en le concaténant avec le nom du activite et l'email de l'utilisateur qui a valider le activite.
            $notification->message = "La finition de l'activite : " . $activite->libelle . " viens d'etre valider par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;

            $notification->save();
        } else if ($this->statut == "arrêté") {
            // creer une notification pour la rejet du activite
            $notification = new Notification;
            // selectionner l'utilisateur qui a rejeter le activite
            $notification->user_id = Auth::user()->id;
            $notification->type = "Activité";
            // donner le titre de la notification (le statut du activite)
            $notification->titre = "Arrestation d'une activite";
            // donner le message de la notification en le concaténant avec le nom du activite et l'email de l'utilisateur qui a rejeter le activite.
            $notification->message = "L'activite : " . $activite->libelle . " viens d'etre arrêter par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;
            $notification->save();
        } else {
            // creer une notification pour la rejet du activite
            $notification = new Notification;
            // selectionner l'utilisateur qui a rejeter le activite
            $notification->user_id = Auth::user()->id;
            $notification->type = "Activité";
            // donner le titre de la notification (le statut du activite)
            $notification->titre = "Mise en attente d'une activite";
            // donner le message de la notification en le concaténant avec le nom du activite et l'email de l'utilisateur qui a rejeter le activite.
            $notification->message = "L'activite : " . $activite->libelle . " est mise en attente par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;
            $notification->save();
        }


        // associer le statut du activite
        if ($this->statut != null && $this->date_debut != null && $this->date_fin != null) {
            $activite->statut = $this->statut;
            $activite->date_debut = $this->date_debut;
            $activite->date_fin = $this->date_fin;

            if ($activite->statut == "en cours") {
                $activite->statut = $this->statut;
                $activite->date_debut = $this->date_debut;
                $activite->date_fin = $this->date_fin;
                $activite->save();

                return redirect("activites")->with('En cours', 'L\'activite vient de démarré');

            } else if ($activite->statut == "terminé") {

                $activite->statut = $this->statut;
                $activite->date_debut = $this->date_debut;
                $activite->date_fin = $this->date_fin;

                // Sauvegardez les modifications avec la fonction save()
                $activite->save();

                return redirect("activites")->with('terminer', 'Vous venez de notifier la finalisation de l\'activité');

            } else if ($activite->statut == "arrêté") {
                $activite->statut = $this->statut;
                $activite->date_debut = $this->date_debut;
                $activite->date_fin = $this->date_fin;

                $activite->save();

                return redirect("activites")->with('rejeter', 'Le activite a été arrêté');

            } else if ($activite->statut == "en attente") {
                $activite->statut = $this->statut;
                $activite->date_debut = $this->date_debut;
                $activite->date_fin = $this->date_fin;
                $activite->save();
                return redirect("activites")->with('Enattente', 'L\'activite est toujours en attente');
            }
        }

        // retourner sur la page des activites si aucun statut n'est selectionner
        return redirect('activites');
    }

    public function render()
    {

        $listeActivites = Activite::where('nom', 'like', '%' . $this->search . '%')
            ->paginate(5);

        return view('livewire.liste-activite', compact('listeActivites'));
    }
}