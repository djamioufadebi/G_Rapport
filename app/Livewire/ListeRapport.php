<?php

namespace App\Livewire;

use App\Models\Projet;
use App\Models\Rapport;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;
use App\Models\Notification;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListeRapport extends Component
{
    use WithPagination;

    public $rapport;
    public $statut;

    public $search = '';

    public function mount()
    {
        $rapport = Rapport::with('projet')->get();
    }

    public function confirmDelete($id)
    {
        $rapport = Rapport::find($id);
        // verifie si l'utilisateur a l'autorisation de supprimer
        //$this->authorize('delete', $rapport);
        // creer une notification pour la suppresion du rapport
        $notification = new Notification;
        $notification->user_id = Auth::user()->id;
        $notification->titre = "Suppression d'un rapport";
        $notification->message = "Le rapport : " . $rapport->libelle . " viens d'etre supprimer par :" . Auth::user()->email;
        $notification->read = false;

        $notification->save();


        //  selectionner le Projet à supprimer avec la fonction find() et le supprimer avec la fonction delete()
        $rapport->delete();
        return redirect("rapports")->with('delete', 'Le rapport à été supprimé');
    }

    public function confirmSaveRapport($id)
    {
        $rapport = Rapport::find($id);

        if ($this->statut == "Validé") {
            // creer une notification pour la validation du rapport
            $notification = new Notification;
            // selectionner l'utilisateur qui a valider le rapport
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du rapport)
            $notification->titre = "Validation d'un rapport";
            // donner le message de la notification en le concaténant avec le nom du rapport et l'email de l'utilisateur qui a valider le rapport.
            $notification->message = "Le rapport : " . $rapport->libelle . " viens d'etre valider par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
            $notification->read = false;

            $notification->save();
        } else if ($this->statut == "rejeté") {
            // creer une notification pour la rejet du rapport
            $notification = new Notification;
            // selectionner l'utilisateur qui a rejeter le rapport
            $notification->user_id = Auth::user()->id;
            // donner le titre de la notification (le statut du rapport)
            $notification->titre = "Rejet d'un rapport";
            // donner le message de la notification en le concaténant avec le nom du rapport et l'email de l'utilisateur qui a rejeter le rapport.
            $notification->message = "Le rapport : " . $rapport->libelle . " viens d'etre rejeter par :" . Auth::user()->email;
            // marquer la notification comme lu ou non lu
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
            $rapport->statut = "en attente";

            // Sauvegardez les modifications avec la fonction save() et retourner sur la page des rapports
            $rapport->save();
            return redirect("rapports")->with('en attente', 'Le rapport est toujours en attente');
        }
        // retourner sur la page des rapports si aucun statut n'est selectionner
        return redirect()->back();
    }

    public function render()
    {

        $listeRapport = Rapport::latest()->paginate(10);

        if ($this->search) {

            $search = Rapport::where('libelle', 'Like', '%'
                . $this->search . '%')->orwhere('contenu', 'Like', '%'
                    . $this->search . '%')->orwhere('created_at', 'Like', '%'
                    . $this->search . '%')->get();
            dd($search);
        } else {
            $listeRapport = Rapport::latest()->paginate(10);
        }

        return view('livewire.liste-rapport', compact('listeRapport'));
    }
}
