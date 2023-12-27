<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class RapportController extends Controller
{

    public function delete(User $user, Rapport $rapport)
    {
        // Vérification basée sur le profil de l'utilisateur
        if ($user->id_profil == 2) {
            return true; // L'administrateur peut supprimer n'importe quel rapport
        } else {
            return view('composants.acces_refuser'); // L'éditeur peut supprimer ses propres posts
        }

        //return false; // Par défaut, les utilisateurs ne peuvent pas supprimer les posts
    }

    public function index()
    {
        if (Gate::allows('viewliste', Rapport::class)) {
            return view('rapports.liste');
        } else {
            return view('composants.redirection-new-user'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function create()
    {
        return view('rapports.create');
    }

    public function edit(Rapport $rapport)
    {
        if (Gate::allows('edit', $rapport)) {
            return view('rapports.edit', compact('rapport'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function show(Rapport $rapport)
    {
        if (Gate::allows('wiew', $rapport)) {
            return view('rapports.show', compact('rapport'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

}
