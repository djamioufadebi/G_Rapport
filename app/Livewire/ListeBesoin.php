<?php

namespace App\Livewire;

use App\Models\Besoin;
use App\Models\Projet;
use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ListeBesoin extends Component
{

    public $statut;

    public function confirmDelete($id)
    {
        $besoin = Besoin::find($id);

        // creer une notification pour la suppresion du besoin
        $notification = new Notification;
        // selectionner l'utilisateur qui a supprimer le besoin
        $notification->user_id = Auth::user()->id;
        // donner le titre de la notification
        $notification->titre = "Suppression d'un besoin";
        // donner le message de la notification en le concaténant avec le nom du besoin et l'email de l'utilisateur qui a supprimer le besoin.
        $notification->message = "Le besoin : " . $besoin->libelle . " viens d'etre supprimer par :" . Auth::user()->email;
        $notification->read = false;

        $notification->save();

        //  selectionner le besoin à supprimer avec la fonction find() et le supprimer avec la fonction delete()
        $besoin->delete();
        return redirect("besoins")->with('delete', 'Le rapport à été supprimé');
    }

    public function confirmSaveBesoin($id)
    {
        $besoin = Besoin::find($id);

        if ($this->statut == "Validé") {
            // creer une notification pour la validation du besoin
            $notification = new Notification;
            // selectionner l'utilisateur qui a valider le besoin
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du besoin)
            $notification->titre = "Validation d'un besoin";
            // donner le message de la notification en le concaténant avec le nom du besoin et l'email de l'utilisateur qui a valider le besoin.
            $notification->message = "Le besoin : " . $besoin->libelle . " viens d'etre valider par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;

            $notification->save();
        } else if ($this->statut == "rejeté") {
            // creer une notification pour la rejet du besoin
            $notification = new Notification;
            // selectionner l'utilisateur qui a rejeter le besoin
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du besoin)
            $notification->titre = "Rejet d'un besoin";
            // donner le message de la notification en le concaténant avec le nom du besoin et l'email de l'utilisateur qui a rejeter le besoin.
            $notification->message = "Le besoin : " . $besoin->libelle . " viens d'etre rejeter par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;
            $notification->save();
        }


        // associer le statut du besoin
        if ($this->statut != null) {
            $besoin->statut = $this->statut;
            if ($besoin->statut == "Validé") {
                // Sauvegardez les modifications avec la fonction save()
                $besoin->save();
                return redirect("besoins")->with('valider', 'Le besoin a été validé');
            } else if ($besoin->statut == "rejeté") {
                $besoin->save();
                return redirect("besoins")->with('rejeter', 'Le besoin a été rejeté');
            }
        } else {
            $besoin->statut = "en attente";

            // Sauvegardez les modifications avec la fonction save() et retourner sur la page des besoins
            $besoin->save();
            return redirect("besoins")->with('en attente', 'Le besoin est toujours en attente');
        }

        // retourner sur la page des besoins si aucun statut n'est selectionner
        return redirect()->back();
    }

    public function render()
    {
        $listeBesoins = Besoin::latest()->paginate(10);

        return view('livewire.liste-besoin', compact('listeBesoins'));
    }
}