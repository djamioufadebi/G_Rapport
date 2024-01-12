<?php

namespace App\Policies;

use App\Models\Intervenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IntervenantPolicy
{

    use HandlesAuthorization;

    public function viewliste(User $user)
    {

        return in_array($user->id_profil, [1, 2]);
    }

    public function create(User $user)
    {
        // Seuls les administrateurs peuvent créer un intervenant
        return $user->id_profil === 1 || $user->id_profil === 2;
    }

    public function edit(User $user, Intervenant $intervenant)
    {
        // Seuls l'utilisateur ayant l'id profil 2 ou 2 ou l'utilisateur propriétaire de l'activité peuvent éditer un intervenant
        return $user->id_profil === 1 || $user->id_profil === 2;
    }

    public function view(User $user, Intervenant $intervenant)
    {
        // Autoriser tous les utilisateurs à voir un intervenant
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
