<?php

namespace App\Http\Controllers;

use Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Rapport;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RapportController extends Controller
{
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
        if (Gate::allows('view', $rapport)) {
            return view('rapports.show', compact('rapport'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function pdfRapport()
    {

        $dateToday = Carbon::now();
        // recuperer les rapports de l'utilisateur connecté et les afficher
        $user = Auth::user();
        if ($user->id_profil == 1 || $user->id_profil == 2) {
            $rapports = Rapport::all();
            $pdf = Pdf::loadView('PDF.rapports_pdf', compact('rapports', 'dateToday'));
            return $pdf->stream();

        } else {
            // recuperer les rapports de l'utilisateur connecté
            $rapports = Rapport::where('user_id', $user->id)->get();
            $pdf = Pdf::loadView('PDF.rapports_pdf', compact('rapports', 'dateToday'));
            return $pdf->stream();
        }

    }

    public function rapportpdf(Rapport $rapport)
    {
        $rapports = Rapport::find($rapport);
        $pdf = Pdf::loadView('PDF.rapport_pdf', compact('rapports'));
        return $pdf->stream();
    }

}
