<?php

namespace App\Livewire;

use App\Models\Besoin;
use App\Models\Projet;
use Livewire\Component;
use App\Models\Notification;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ListeBesoin extends Component
{

    use WithPagination;
    public $statut;
    public $search;

    public function s()
    {
    }

    public function confirmDelete($id)
    {
        $besoin = Besoin::find($id);

        // creer une notification pour la suppression du besoin
        $notification = new Notifications;
        $notification->besoin_id = $id;
        $notification->type = "besoin";
        $notification->user_id = Auth::user()->id;
        $notification->titre = "Suppression d'un besoin";
        $notification->message = "Le besoin : " . $besoin->libelle . " viens d'etre supprimer.";
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
            $notification = new Notifications;
            $notification->besoin_id = $id;
            $notification->type = "besoin";
            $notification->user_id = Auth::user()->id;
            $notification->titre = "Validation d'un besoin";
            $notification->message = "Le besoin : " . $besoin->libelle . " viens d'etre validé.";
            $notification->read = false;

            $notification->save();
        } else if ($this->statut == "rejeté") {
            // creer une notification pour la rejet du besoin
            $notification = new Notifications;
            $notification->besoin_id = $id;
            $notification->type = "besoin";
            $notification->user_id = Auth::user()->id;
            $notification->titre = "Rejet d'un besoin";
            $notification->message = "Le besoin : " . $besoin->libelle . " viens d'etre rejeté.";
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

        $word = '%' . $this->search . '%';

        $listeBesoins = Besoin::where('libelle', 'like', $word)->orwhere('created_at', 'like', $word)->orwhere('contenu', 'like', $word);

        $user = Auth::user();
        // Si l'utilisateur n'est pas admin, afficher uniquement les besoins qu'il a creer
        if ($user->id_profil != 1) {
            // Si l'utilisateur n'est ni manager ni admin, afficher uniquement les besoins qu'il a creer
            $listeBesoins->where('user_id', $user->id);
        }

        $listeBesoins = $listeBesoins->paginate(10);

        return view('livewire.liste-besoin', compact('listeBesoins'));
    }
}
