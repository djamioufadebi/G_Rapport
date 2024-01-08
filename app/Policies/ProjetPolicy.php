<?php

namespace App\Policies;

use App\Models\Projet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjetPolicy
{
    use HandlesAuthorization;

    public function viewliste(User $user)
    {
        // Seuls les utilisateurs ayant le profil  2 ou 3 ou 4 ou 5 peuvent voir la liste des projets
        return in_array($user->id_profil, [1, 2]);
    }

    public function create(User $user)
    {
        // Seuls les administrateurs peuvent créer un projet
        return $user->id_profil === 1 || $user->id_profil === 2;
    }

    public function edit(User $user, Projet $projet)
    {
        // Seuls l'utilisateur ayant l'id profil 3 ou 2 ou l'utilisateur propriétaire de l'activité peuvent éditer une activité
        return $user->id_profil === 1 || $user->id_profil === 2;
        //|| $user->id === $projet->user_id;
    }

    public function view(User $user, Projet $projet)
    {
        // Autoriser tous les utilisateurs à voir un projet
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