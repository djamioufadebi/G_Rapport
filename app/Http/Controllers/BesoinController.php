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
        if ($user->id_profil == 2) {
            $besoins = Besoin::all();
            // $data = ['title' => 'Liste des utilisateurs'];
            $pdf = Pdf::loadView('PDF.besoins_pdf', ['besoins' => $besoins]);
            // return $pdf->download('liste_des_utilisateurs.pdf');
            return $pdf->stream();
        } else {
            return view('composants.acces_refuser');
        }


    }

}
