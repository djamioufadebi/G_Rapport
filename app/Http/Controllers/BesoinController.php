<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Gate;
use Illuminate\Http\Request;

class BesoinController extends Controller
{

    public function index()
    {
        if (Gate::allows('viewliste', Besoin::class)) {
            return view('besoins.liste');
        } else {
            return view('composants.redirection-new-user'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function create()
    {
        return view('besoins.create');
    }

    public function edit(Besoin $besoin)
    {
        if (Gate::allows('edit', $besoin)) {
            return view('besoins.edit', compact('besoin'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function show(Besoin $besoin)
    {
        if (Gate::allows('view', $besoin)) {
            return view('besoins.show', compact('besoin'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }
    public function pdfBesoin()
    {
        $user = Auth::user();
        // seul le profil 1 et 2 peuvent accéder à cette vue de generation de pdf (pdfBesoin)
        if ($user->id_profil == 1 || $user->id_profil == 2) {
            $besoins = Besoin::all();
            $pdf = Pdf::loadView('PDF.besoins_pdf', ['besoins' => $besoins]);
            return $pdf->stream();
        } else {
            // recuperer les besoins de l'utilisateur connecté
            $besoins = Besoin::where('user_id', $user->id)->get();
            $pdf = Pdf::loadView('PDF.besoins_pdf', ['besoins' => $besoins]);
            return $pdf->stream();
            // return view('composants.acces_refuser');
        }
    }

    // fonction de generation de pdf d'un besoin spécifique

    public function besoinpdf(Besoin $besoin)
    {
        $besoins = Besoin::find($besoin);
        $pdf = Pdf::loadView('PDF.besoin_pdf', compact('besoins'));
        return $pdf->stream();
    }

}