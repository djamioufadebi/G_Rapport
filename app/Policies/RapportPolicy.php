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
        return in_array($user->id_profil, [1, 2, 3, 4, 6]);
    }

    public function create(User $user)
    {
        //Tout le monde peut créer un rapport
        return true;
    }

    public function edit(User $user, Rapport $rapport)
    {
        // Seuls l'utilisateur ayant l'id profil 2 ou l'utilisateur propriétaire du rapport peuvent éditer un rapport
        return $user->id_profil === 1 || $user->id_profil === 2 || $user->id === $rapport->user_id;
    }

    public function view(User $user, Rapport $rapport)
    {
        // Autoriser tous les utilisateurs à voir un rapport
        return $user->id_profil === 1 || $user->id_profil === 2;
    }

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }
}
