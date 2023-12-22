<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Gate;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        if (Gate::allows('viewliste', Client::class)) {
            return view('Clients.liste');
        } else {
            return view('composants.redirection-new-user'); // Redirection vers une vue indiquant un accès refusé
        }

    }

    public function create()
    {
        if (Gate::allows('create', Client::class)) {
            return view('Clients.create');
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function edit(Client $client)
    {
        if (Gate::allows('edit', $client)) {
            return view('Clients.edit', compact('client'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function show(Client $client)
    {
        if (Gate::allows('view', $client)) {
            return view('Clients.show', compact('client'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }
}
