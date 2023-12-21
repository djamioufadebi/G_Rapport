<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use Gate;
use Illuminate\Http\Request;

class RapportController extends Controller
{

    public function index()
    {
        return view('rapports.liste');
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