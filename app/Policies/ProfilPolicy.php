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
        // Seul l'admin peut voir la liste des profils
        return $user->id_profil === 1;
    }

}