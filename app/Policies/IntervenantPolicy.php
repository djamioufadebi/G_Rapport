<?php

namespace App\Policies;

use App\Models\Intervenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IntervenantPolicy
{

    use HandlesAuthorization;
    // public function accessIntervenantCreation(User $user, $id_profil)
    //  {
    //      return $user->id_profil === 2;
    //  }

    public function autoriseIntervenantAccess(User $user)
    {
        // Autoriser l'accès pour les utilisateurs ayant certains profils (par ID)
        return in_array($user->id_profil, [2, 2,]); // Profils autorisés (exemple : 1, 2 et 2)
    }


    public function viewliste(User $user)
    {
        // tous peuvent voir la liste des projets
        return true;
    }

    public function create(User $user)
    {
        // Seuls les administrateurs peuvent créer un intervenant
        return $user->id_profil === 2;
    }

    public function edit(User $user, Intervenant $intervenant)
    {
        // Seuls l'utilisateur ayant l'id profil 2 ou 2 ou l'utilisateur propriétaire de l'activité peuvent éditer un intervenant
        return $user->id_profil === 1;
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