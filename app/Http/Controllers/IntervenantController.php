<?php

namespace App\Http\Controllers;

use App\Models\Intervenant;
use Gate;
use Illuminate\Http\Request;

class IntervenantController extends Controller
{

    public function index()
    {
        return view('intervenants.liste');
    }

    public function create()
    {
        if (Gate::allows('create', Intervenant::class)) {
            return view('intervenants.create');
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function edit(Intervenant $intervenant)
    {
        if (Gate::allows('edit', $intervenant)) {
            return view('intervenants.edit', compact('intervenant'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function show(Intervenant $intervenant)
    {
        if (Gate::allows('view', $intervenant)) {
            return view('intervenants.show', compact('intervenant'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

}