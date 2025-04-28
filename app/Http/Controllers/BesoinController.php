<?php

namespace App\Http\Controllers;

use App\Models\Besoin;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BesoinController extends Controller
{

    public function index()
    {
        if (Gate::allows('viewliste', Besoin::class)) {
            return view('Besoins.liste');
        } else {
            return view('composants.redirection-new-user'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function create()
    {
        return view('Besoins.create');
    }

    public function edit(Besoin $besoin)
    {
        if (Gate::allows('edit', $besoin)) {
            return view('Besoins.edit', compact('besoin'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function show(Besoin $besoin)
    {

        if (Gate::allows('view', $besoin)) {
            return view('Besoins.show', compact('besoin'));
        } 
        else 
        {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }

    }
    public function pdfBesoin()
    {
        $dateToday = Carbon::now();
        $user = Auth::user();
        // seul le profil 1 et 2 peuvent accéder à cette vue de generation de pdf (pdfBesoin)
        if ($user->id_profil == 1 || $user->id_profil == 2) {
            $besoins = Besoin::all();

            $pdf = Pdf::loadView('PDF.besoins_pdf', compact('besoins', 'dateToday'));
            return $pdf->stream();
        } else 
        {
            // recuperer les besoins de l'utilisateur connecté
            $besoins = Besoin::where('user_id', $user->id)->get();
            $pdf = Pdf::loadView('PDF.besoins_pdf', compact('besoins', 'dateToday'));
            return $pdf->stream();
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
