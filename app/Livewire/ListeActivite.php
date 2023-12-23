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

    use WithPagination;

    public function confirmDelete($id)
    {
        $activite = Activite::find($id);

        // creer une notification pour la suppresion du activite
        $notification = new Notification;
        // selectionner l'utilisateur qui a supprimer le activite
        $notification->user_id = Auth::user()->id;
        // donner le titre de la notification
        $notification->titre = "Suppression d'une activite";
        // donner le message de la notification en le concaténant avec le nom du activite et l'email de l'utilisateur qui a supprimer le activite.
        $notification->message = "L'activite : " . $activite->libelle . " viens d'etre supprimer par :" . Auth::user()->email;
        $notification->read = false;

        $notification->save();

        //  selectionner le activite à supprimer avec la fonction find() et le supprimer avec la fonction delete()
        $activite->delete();
        return redirect("activites")->with('delete', 'Le rapport à été supprimé');
    }

    public function ValidationStatutActivite($id)
    {
        $activite = Activite::find($id);

        if ($this->statut == "terminé") {
            // creer une notification pour la Finition du activite
            $notification = new Notification;
            // selectionner l'utilisateur qui a valider le activite
            $notification->user_id = Auth::user()->id;
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
            // donner le titre de la notification (le statut du activite)
            $notification->titre = "Arrestation d'une activite";
            // donner le message de la notification en le concaténant avec le nom du activite et l'email de l'utilisateur qui a rejeter le activite.
            $notification->message = "L'activite : " . $activite->libelle . " viens d'etre arrêter par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;
            $notification->save();
        }


        // associer le statut du activite
        if ($this->statut != null) {
            $activite->statut = $this->statut;
            if ($activite->statut == "terminé") {
                // Sauvegardez les modifications avec la fonction save()
                $activite->save();
                return redirect("activites")->with('terminer', 'Vous venez de notifier la finalisation de l\'activité');
            } else if ($activite->statut == "arrêté") {
                $activite->save();
                return redirect("activites")->with('rejeter', 'Le activite a été arrêté');
            }
        } else {
            $activite->statut = "en cours";

            // Sauvegardez les modifications avec la fonction save() et retourner sur la page des activites
            $activite->save();
            return redirect("activites")->with('En cours', 'L\'activite est toujours En cours');
        }

        // retourner sur la page des activites si aucun statut n'est selectionner
        return redirect('activites');
    }

    public function render()
    {
        $listeActivites = Activite::latest()->paginate(5);

        return view('livewire.liste-activite', compact('listeActivites'));
    }
}
