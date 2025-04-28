<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjetController extends Controller
{

    public function index()
    {
        if (Gate::allows('viewliste', Projet::class)) {
            return view('Projets.liste');
        } else {
            return view('composants.redirection-new-user'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function create()
    {
        if (Gate::allows('create', Projet::class)) {
            return view('Projets.create');
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function edit(Projet $projet)
    {
        if (Gate::allows('edit', $projet)) {
            return view('Projets.edit', compact('projet'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function show(Projet $projet)
    {
        if (Gate::allows('view', $projet)) {
            return view('Projets.show', compact('projet'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function pdfProjet()
    {
        $dateToday = Carbon::now();
        $user = Auth::user();
        if ($user->id_profil == 1) {
            $projets = Projet::all();
            $pdf = Pdf::loadView('PDF.projets_pdf', compact('projets', 'dateToday'));
            return $pdf->stream();
        } else {
            $projets = Projet::where('id_gestionnaire', '=', $user->id)->get();
            $pdf = Pdf::loadView('PDF.projets_pdf', compact('projets', 'dateToday'));
            return $pdf->stream();
        }
    }


}