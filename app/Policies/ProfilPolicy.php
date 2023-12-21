<?php

namespace App\Policies;

use App\Models\User;

class ProfilPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewliste(User $user)
    {
        // Seuls les utilisateurs ayant le profil  2 ou 3 ou 4 ou 5 peuvent voir la liste des projets
        return $user->id_profil === 1;
    }

}
