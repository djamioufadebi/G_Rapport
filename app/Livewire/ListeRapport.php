<?php

namespace App\Livewire;

use App\Models\Projet;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Notification;
use Livewire\WithPagination;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class ListeRapport extends Component
{
    use WithPagination;

    public $rapport;
    public $statut;

    public $search;

    public function mount()
    {
        $rapport = Rapport::with('activite')->get();
    }

    public function s()
    {
    }

    public function confirmDelete($id)
    {
        $rapport = Rapport::find($id);
        // verifie si l'utilisateur a l'autorisation de supprimer
        //$this->authorize('delete', $rapport);

        // creer une notification pour la suppression du rapport
        $notification = new Notifications;
        $notification->rapport_id = $id;
        $notification->user_id = Auth::user()->id;
        $notification->type = "rapport";
        $notification->titre = "Suppression d'un rapport";
        $notification->message = "Le rapport : " . $rapport->libelle . " viens d'etre supprimer.";
        $notification->read = false;

        $notification->save();

        //  selectionner le Projet à supprimer avec la fonction find() et le supprimer avec la fonction delete()
        $rapport->delete();
        return redirect("rapports")->with('delete', 'Le rapport à été supprimé');
    }

    public function confirmSaveRapport($id)
    {
        $rapport = Rapport::find($id);

        // recupéurer l'id de l'utilisateur connecté
        $user = Auth::user();
        // if ($user->id_profil == 1) {
        // Si l'utilisateur est admin, il peut modifier les rapports
        if ($this->statut == "Validé") {
            // creer une notification pour la validation du rapport
            $notification = new Notifications;
            $notification->rapport_id = $id;
            $notification->user_id = Auth::user()->id;
            $notification->type = "rapport";
            $notification->titre = "Validation d'un rapport";
            $notification->message = "Le rapport : " . $rapport->libelle . " viens d'etre validé.";
            $notification->read = false;

            $notification->save();
        } else if ($this->statut == "rejeté") {
            // creer une notification pour la rejet du rapport
            $notification = new Notifications;
            $notification->rapport_id = $id;
            $notification->user_id = Auth::user()->id;
            $notification->type = "rapport";
            $notification->titre = "Rejet d'un rapport";
            $notification->message = "Le rapport : " . $rapport->libelle . " viens d'etre rejeté.";
            $notification->read = false;

            $notification->save();
        } else if ($this->statut == "en attente") {
            // creer une notification pour la rejet du rapport
            $notification = new Notifications;
            $notification->rapport_id = $id;
            $notification->user_id = Auth::user()->id;
            $notification->type = "rapport";
            $notification->titre = "Attente d'un rapport";
            $notification->message = "Le rapport : " . $rapport->libelle . " est en attente.";
            $notification->read = false;

            $notification->save();
        }


        // associer le statut du rapport
        if ($this->statut != null) {
            $rapport->statut = $this->statut;
            if ($rapport->statut == "Validé") {
                // Sauvegardez les modifications avec la fonction save()
                $rapport->save();
                return redirect("rapports")->with('valider', 'Le rapport a été validé');
            } else if ($rapport->statut == "rejeté") {
                $rapport->save();
                return redirect("rapports")->with('rejeter', 'Le rapport a été rejeté');
            }
        } else {
            $rapport->statut == "en attente";

            // Sauvegardez les modifications avec la fonction save() et retourner sur la page des rapports
            $rapport->save();
            return redirect("rapports")->with('en attente', 'Le rapport est toujours en attente');
        }
        return redirect()->back();


    }

    public function render()
    {
        $word = '%' . $this->search . '%';
        $listeRapport = Rapport::where('libelle', 'like', $word)
            ->orwhere('difficultes_rencontrees', 'like', $word)
            ->orwhere('solutions_apportees', 'like', $word)->latest()->paginate(10);;

        $user = Auth::user();
        // Si l'utilisateur n'est pas admin, afficher uniquement les rapports qu'il a creer
        if ($user->id_profil == 1) {
            $listeRapport = Rapport::latest()->paginate(10);
            // Si l'utilisateur est admin, afficher tous les rapports qui ont été créé
        } else {
            $listeRapport = Rapport::where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('livewire.liste-rapport', compact('listeRapport'));
    }
}
