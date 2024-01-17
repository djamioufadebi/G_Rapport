<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    public function pdfClient()
    {
        $dateToday = Carbon::now();
        $user = Auth::user();
        if ($user->id_profil == 1 || $user->id_profil == 2 || $user->id_profil == 3) {
            $clients = Client::all();
            // $data = ['title' => 'Liste des utilisateurs'];
            $pdf = Pdf::loadView('PDF.clients_pdf', compact('clients', 'dateToday'));
            // return $pdf->download('liste_des_utilisateurs.pdf');
            return $pdf->stream();
        } else {
            return view('composants.acces_refuser');
        }


    }


}