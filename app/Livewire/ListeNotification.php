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

        $NotReadNotifications = Notifications::where('read', false)
            ->when($user->id_profil == 1, function ($query) use ($user) {
                return $query->where('user_id', '!=', $user->id);
            })
            ->when($user->id_profil != 1, function ($query) use ($user) {
                return $query->leftJoin('rapports', 'notifications.rapport_id', '=', 'rapports.id')
                    ->leftJoin('besoins', 'notifications.besoin_id', '=', 'besoins.id')
                    ->leftJoin('projets', 'notifications.projet_id', '=', 'projets.id')
                    ->where(function ($subquery) use ($user) {
                        $subquery->where('rapports.user_id', $user->id)
                            ->orWhere('besoins.user_id', $user->id)
                            ->orWhere('projets.id_gestionnaire', $user->id);
                    })
                    ->where(function ($subquery) {
                        $subquery->where('titre', 'Validation d\'un rapport')
                            ->orWhere('titre', 'Rejet d\'un rapport')
                            ->orWhere('titre', 'Validation d\'un besoin')
                            ->orWhere('titre', 'Rejet d\'un besoin')
                            ->orWhere('titre', 'Nomination');
                    })
                    ->select('notifications.*');
            })
            ->orderByDesc('created_at')
            ->paginate(10);


        return view('livewire.liste-notification', compact('NotReadNotifications'));
    }
}