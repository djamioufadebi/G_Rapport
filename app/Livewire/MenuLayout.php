<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class MenuLayout extends Component
{
    public function render()
    {
        $user = Auth::user();

        // Les notifications
        $CountNotReadNotifications = Notifications::where('read', false)
        ->leftJoin('rapports', 'notifications.rapport_id', '=', 'rapports.id')//Notifications concernant les rapports de l'utilisateur connecter
        ->leftJoin('besoins', 'notifications.besoin_id', '=', 'besoins.id')//Notifications concernant les besoins de l'utilisateur connecter
        ->where(function ($query) use ($user) {
            $query->where('rapports.user_id', $user->id)//Rapports de l'utilisateur connecter
                ->orWhere('besoins.user_id', $user->id);//Besoins de l'utilisateur connecter
        })
        ->select('notifications.*')
        ->count();
        
        return view('livewire.menu-layout', compact('CountNotReadNotifications'));
    }
}
