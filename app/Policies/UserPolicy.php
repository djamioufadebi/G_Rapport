<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewliste(User $user)
    {
        // Seuls les utilisateurs ayant le profil  1 peuvent voir la liste des projets
        return $user->id_profil === 1;
    }
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}