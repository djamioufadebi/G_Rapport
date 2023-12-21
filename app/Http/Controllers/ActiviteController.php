<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Gate;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // tout les users peut voir la liste des rapports des activites
        return view('Activites.liste');
    }

    public function create()
    {
        // politique d'autorisation définie dans la page de Policy permettant de refuser l'accès à la page d'ajout d'activité si l'utilisateur n'a pas un bon profil
        if (Gate::allows('create', Activite::class)) {
            return view('Activites.create');
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function edit(Activite $activite)
    {
        // politique d'autorisation définie dans la page de Policy
        //$this->authorize('edit', $activite);
        if (Gate::allows('edit', $activite)) {
            return view('Activites.edit', compact('activite'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function show(Activite $activite)
    {
        // politique d'autorisation définie dans la page de Policy
        // $this->authorize('view', $activite);
        if (Gate::allows('view', $activite)) {
            return view('Activites.show', compact('activite'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

}