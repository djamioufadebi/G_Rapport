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


    // fonction pour supprimer un Projet avec une confirmation avant de suppression
    // public function confirmDelete($id)
    // {
    //  selectionner le Projet à supprimer avec la fonction find() et le supprimer avec la fonction delete()
    //    $selectedItemId = Projet::find($id)->delete();

    //     $this->selectedItemId = $selectedItemId;
    //    return redirect("projets")->with('delete', 'Le Projet à été supprimé');
    // }

    public function confirmDelete($id)
    {
        $projet = Projet::find($id);

        // creer une notification pour la suppresion du projet
        $notification = new Notification;
        // selectionner l'utilisateur qui a supprimer le projet
        $notification->user_id = Auth::user()->id;
        // donner le titre de la notification
        $notification->titre = "Suppression d'une Projet";
        // donner le message de la notification en le concaténant avec le nom du Projet et l'email de l'utilisateur qui a supprimer le Projet.
        $notification->message = "Le Projet : " . $projet->libelle . " viens d'etre supprimer par :" . Auth::user()->email;
        $notification->read = false;

        $notification->save();

        //  selectionner le Projet à supprimer avec la fonction find() et le supprimer avec la fonction delete()
        $projet->delete();
        return redirect("projets")->with('delete', 'Le rapport à été supprimé');
    }


    public function ValidationStatutProjet($id)
    {
        $projet = Projet::find($id);

        if ($this->statut == "terminé") {
            // creer une notification pour la Finition du Projet
            $notification = new Notification;
            // selectionner l'utilisateur qui a valider le Projet
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du Projet)
            $notification->titre = "Finition d'un Projet";
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
            // donner le message de la notification en le concaténant avec le nom du Projet et l'email de l'utilisateur qui a rejeter le Projet.
            $notification->message = "Le Projet : " . $projet->libelle . " viens d'etre arrêter par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;
            $notification->save();
        }


        // associer le statut du projet
        if ($this->statut != null) {
            $projet->statut = $this->statut;
            if ($projet->statut == "terminé") {
                // Sauvegardez les modifications avec la fonction save()
                $projet->save();
                return redirect("projets")->with('terminer', 'Vous venez de notifier la finalisation du projet');
            } else if ($projet->statut == "arrêté") {
                $projet->save();
                return redirect("projets")->with('rejeter', 'Le Projet a été arrêté');
            }
        } else {
            $projet->statut = "en cours";

            // Sauvegardez les modifications avec la fonction save() et retourner sur la page des projets
            $projet->save();
            return redirect("projets")->with('En cours', 'Le Projet est toujours en cours');
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
