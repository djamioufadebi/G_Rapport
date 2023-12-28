<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Gate;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        if (Gate::allows('viewliste', Profil::class)) {
            return view('profils.liste');
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function create()
    {
        return view('Profils.create');
    }

    public function edit(Profil $profil)
    {
        return view('Profils.edit', compact('profil'));
    }

    public function show(Profil $profil)
    {
        return view('Profils.show', compact('profil'));
    }

    public function pdfProfil()
    {
        $profils = Profil::all();
        $pdf = Pdf::loadView('PDF.profils_pdf', ['profils' => $profils]);
        // return $pdf->download('liste_des_utilisateurs.pdf');
        return $pdf->stream();
    }

}
