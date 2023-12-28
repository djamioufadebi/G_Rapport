<?php

namespace App\Policies;

use App\Models\Activite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivitePolicy
{

    use HandlesAuthorization;

    //public function autoriseActiviteAccess(User $user)
    //{
    // Autoriser l'accès pour les utilisateurs ayant certains profils (par ID)
    //   return in_array($user->id_profil, [2, 3, 4]); // Profils autorisés (exemple : 1, 2 et 3)
    // }
    //public function autoriseActivitCreation(User $user)
    // {
    // Autoriser l'accès pour les utilisateurs ayant certains profils (par ID)
    //  return in_array($user->id_profil, [2, 3]); // Profils autorisés (exemple : 1, 2 et 3)
    // }

    public function autoriseActiviteValidation(User $user)
    {
        // Autoriser l'accès pour les utilisateurs ayant certains profils (par ID)
        return $user->id_profil === 3;
        //in_array($user->id_profil, [1, 2, 3, 4]); // Profils autorisés (exemple : 1, 2 et 3)
    }


    public function viewliste(User $user)
    {
        return in_array($user->id_profil, [1, 2, 3, 4, 6]);

    }

    public function create(User $user)
    {
        // Seuls les administrateurs peuvent créer une activité
        return $user->id_profil === 1 || $user->id_profil === 3;
    }

    public function edit(User $user, Activite $activite)
    {
        // Seuls l'utilisateur ayant l'id profil 3 ou 2 ou l'utilisateur propriétaire de l'activité peuvent éditer une activité
        return $user->id_profil === 1 || $user->id_profil === 2 || $user->id_profil === 3;
    }

    public function view(User $user, Activite $activite)
    {
        // Autoriser tous les utilisateurs à voir une activité
        return $user->id_profil === 1 || $user->id_profil === 2 || $user->id_profil === 3;
    }
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}