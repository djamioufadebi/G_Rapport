<?php

namespace App\Policies;

use App\Models\Besoin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BesoinPolicy
{

    // public function autoriseBesoinValidation(User $user)
    // {
    // Autoriser l'accès pour les utilisateurs ayant certains profils (par ID)
    //    return $user->id_profil === 2;
    //in_array($user->id_profil, [1, 2, 3, 4]); // Profils autorisés (exemple : 1, 2 et 3)
    // }


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
