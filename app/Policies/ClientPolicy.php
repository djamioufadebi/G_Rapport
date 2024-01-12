<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;


    public function viewliste(User $user)
    {
        // Seuls les utilisateurs ayant le profil  2 ou 2 ou 4 ou 5 peuvent voir la liste des projets
        return in_array($user->id_profil, [1, 2]);
    }

    public function create(User $user)
    {
        // Seuls les administrateurs peuvent créer une activité
        return $user->id_profil === 1 || $user->id_profil === 2;
    }

    public function edit(User $user, Client $client)
    {
        // Seuls l'utilisateur ayant l'id profil 2 ou 2 ou l'utilisateur propriétaire de l'activité peuvent éditer une activité
        return $user->id_profil === 1 || $user->id_profil === 2;
    }

    public function view(User $user, Client $client)
    {
        // Autoriser les utilisateurs ayant l'id_profil 2 et 2 à voir une activité
        return $user->id_profil === 1 || $user->id_profil === 2;
    }

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }
}
