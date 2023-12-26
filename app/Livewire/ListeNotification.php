<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class ListeNotification extends Component
{

    public $notifications;
    public function mount()
    {
        // pour récuperer les notifications
        // $this->notifications = auth()->user()->notifications;
    }

    public function marquerLu($id)
    {
        $notification = Notification::find($id);
        $notification->read = true;
        $notification->save();
        // Rafraîchir les notifications après le marquage
        $this->mount();
    }


    public function render()
    {
        // les notifications non lues
        //$NotReadNotificationsCount = Notification::where('read', false)->get();

        // recuperation des notifications d'un utilisateur sp"écifique qui ont été validé ou réjeté


        $NotReadNotifications = Notification::where('read', false)->where('user_id', '=', auth()->user()->id)->get();

        //$NotReadNotificationsCount = count($NotReadNotifications);

        // dd($NotReadNotificationsCount);
        // Les notification des rapports qui ont été validé et rejeté
        // $allNotifications = Notification::where('statut', '=', 'Validé')->orwhere('statut', '=', 'réjeté')->get();
        // dd($NotReadNotificationsCount);

        return view('livewire.liste-notification', compact('NotReadNotifications'));
    }
}
