<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Intervenant;
use Auth;
use Gate;
use Illuminate\Http\Request;

class IntervenantController extends Controller
{

    public function index()
    {
        if (Gate::allows('viewliste', Intervenant::class)) {
            return view('intervenants.liste');
        } else {
            return view('composants.redirection-new-user'); // Redirection vers une vue indiquant un accès refusé
        }
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

    public function pdfIntervenant()
    {
        $user = Auth::user();
        if ($user->id_profil == 1 || $user->id_profil == 2 || $user->id_profil == 3) {
            $intervenants = Intervenant::all();
            // $data = ['title' => 'Liste des utilisateurs'];
            $pdf = Pdf::loadView('PDF.intervenants_pdf', ['intervenants' => $intervenants]);
            // return $pdf->download('liste_des_utilisateurs.pdf');
            return $pdf->stream();
        } else {
            return view('composants.acces_refuser');
        }


    }

}
