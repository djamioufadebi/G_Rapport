<?php

namespace App\Policies;

use App\Models\Rapport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RapportPolicy
{

    use HandlesAuthorization;


    public function viewliste(User $user)
    {
        return true;

    }

    public function create(User $user)
    {
        // Seuls les administrateurs peuvent créer un rapport
        return true;
    }

    public function edit(User $user, Rapport $rapport)
    {
        // Seuls l'utilisateur ayant l'id profil 2 ou l'utilisateur propriétaire du rapport peuvent éditer un rapport
        return $user->id_profil === 2;
    }

    public function view(User $user, Rapport $rapport)
    {
        // Autoriser tous les utilisateurs à voir un rapport
        return $user->id_profil === 2;
    }

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }
}
