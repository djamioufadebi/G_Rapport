<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class ProfilController extends Controller
{
    public function index()
    {
        if (Gate::allows('viewliste', Profil::class)) {
            return view('Profils.liste');
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
        $dateToday = Carbon::now();

        $profils = Profil::all();
        $pdf = Pdf::loadView('PDF.profils_pdf', compact('profils', 'dateToday'));

        return $pdf->stream();
    }

    public function profilpdf($id)
    {

        $profils = Profil::find($id);
        $pdf = Pdf::loadView('PDF.profils_pdf', ['profils' => $profils]);
        return $pdf->stream();
    }

}