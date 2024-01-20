<?php

namespace App\Policies;

use App\Models\Besoin;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class BesoinPolicy
{



    public function viewliste(User $user)
    {
        return in_array($user->id_profil, [1, 2]);
    }

    public function create(User $user)
    {
        // Tout le monde peut créer un besoin
        return true;
    }

    public function edit(User $user, Besoin $besoin)
    {
        $user = Auth::user();
        // Seuls l'utilisateur ayant l'id profil 2 ou l'utilisateur propriétaire de l'activité peuvent éditer une activité
        return $user->id === $besoin->user_id;
    }

    public function view(User $user, Besoin $besoin)
    {
        // Autoriser tous les utilisateurs à voir une activité
        return $user->id_profil === 1 || $user->id === $besoin->user_id;
    }

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}
