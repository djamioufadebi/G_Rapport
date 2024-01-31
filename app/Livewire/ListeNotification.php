<?php

namespace App\Livewire;

use App\Models\Besoin;
use App\Models\Rapport;
use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ListeNotification extends Component
{
    use WithPagination;
    public function read($id)
    {
        $notification = Notifications::find($id);
        $notification->read = true;
        $notification->save();
    }

    //
    public function readAll()
    {
        $notifications = Notifications::where('read', false)->get();

        foreach ($notifications as $n) {
            $n->read = true;
            $n->save();
        }
    }

    public function render()
    {
        $user = Auth::user();

        if ($user->id_profil == 1) {
            // recupérer les notifications non lues et les filtrer de la plus récente au plus ancienne
            $NotReadNotifications = Notifications::where('read', false)
                ->where('user_id', '!=', $user->id)
                ->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $NotReadNotifications = Notifications::where('read', false)
                // jointure avec les rapports et les besoins de l'utilisateur connecter
                ->leftJoin('rapports', 'notifications.rapport_id', '=', 'rapports.id') //Notifications concernant les rapports de l'utilisateur connecter
                ->leftJoin('besoins', 'notifications.besoin_id', '=', 'besoins.id') //Notifications concernant les besoins de l'utilisateur connecter
                ->where(function ($query) use ($user) {
                    $query->where('rapports.user_id', $user->id) //Rapports de l'utilisateur connecter
                        ->orWhere('besoins.user_id', $user->id); //Besoins de l'utilisateur connecter
                })
                ->select('notifications.*')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }


        return view('livewire.liste-notification', compact('NotReadNotifications'));
    }
}
