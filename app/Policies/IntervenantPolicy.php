<?php

namespace App\Policies;

use App\Models\Intervenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IntervenantPolicy
{

    use HandlesAuthorization;
    public function accessIntervenantCreation(User $user, $id_profil)
    {
        return $user->id_profil === 3;
    }

    public function autoriseIntervenantAccess(User $user)
    {
        // Autoriser l'accès pour les utilisateurs ayant certains profils (par ID)
        return in_array($user->id_profil, [2, 3, 4]); // Profils autorisés (exemple : 1, 2 et 3)
    }


    public function viewliste(User $user)
    {
        // Seuls les utilisateurs ayant le profil  2 ou 3 ou 4 ou 5 peuvent voir la liste des projets
        return in_array($user->id_profil, [1, 2, 3, 4, 6]);
    }

    public function create(User $user)
    {
        // Seuls les administrateurs peuvent créer un intervenant
        return $user->id_profil === 3;
    }

    public function edit(User $user, Intervenant $intervenant)
    {
        // Seuls l'utilisateur ayant l'id profil 3 ou 2 ou l'utilisateur propriétaire de l'activité peuvent éditer un intervenant
        return $user->id_profil === 3 || $user->id === $intervenant->user_id;
    }

    public function view(User $user, Intervenant $intervenant)
    {
        // Autoriser tous les utilisateurs à voir un intervenant
        return $user->id_profil === 2 || $user->id_profil === 3;
    }

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}
