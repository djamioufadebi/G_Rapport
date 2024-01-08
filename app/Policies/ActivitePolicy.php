<?php

namespace App\Policies;

use App\Models\Activite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivitePolicy
{

    use HandlesAuthorization;

    public function viewliste(User $user)
    {
        return in_array($user->id_profil, [1, 2]);

    }

    public function create(User $user)
    {
        // Seuls les administrateurs peuvent créer une activité
        return $user->id_profil === 1 || $user->id_profil === 2;
    }

    public function edit(User $user, Activite $activite)
    {
        // Seuls l'utilisateur ayant l'id profil 3 ou 2 ou l'utilisateur propriétaire de l'activité peuvent éditer une activité
        return $user->id_profil === 1 || $user->id_profil === 2;
    }

    public function view(User $user, Activite $activite)
    {
        // Autoriser tous les utilisateurs à voir une activité
        return $user->id_profil === 1 || $user->id_profil === 2;
    }
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}