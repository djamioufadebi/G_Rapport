<?php

namespace App\Policies;

use App\Models\Projet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjetPolicy
{
    use HandlesAuthorization;

    public function autoriseProjetValidation(User $user)
    {
        // Autoriser l'accès pour les utilisateurs ayant certains profils (par ID)
        // return $user->id_profil === 3;
        //in_array($user->id_profil, [1, 2, 3, 4]); // Profils autorisés (exemple : 1, 2 et 3)
    }

    public function viewliste(User $user)
    {
        // Seuls les utilisateurs ayant le profil  2 ou 3 ou 4 ou 5 peuvent voir la liste des projets
        return in_array($user->id_profil, [1, 2, 3, 4, 6]);
    }

    public function create(User $user)
    {
        // Seuls les administrateurs peuvent créer une activité
        return $user->id_profil === 1 || $user->id_profil === 3;
    }

    public function edit(User $user, Projet $projet)
    {
        // Seuls l'utilisateur ayant l'id profil 3 ou 2 ou l'utilisateur propriétaire de l'activité peuvent éditer une activité
        return $user->id_profil === 1 || $user->id_profil === 3;
        //|| $user->id === $projet->user_id;
    }

    public function view(User $user, Projet $projet)
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
