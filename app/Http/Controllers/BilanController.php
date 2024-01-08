<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class BilanController extends Controller
{

    public function index()
    {
        return view('Bilans.bilan');
    }

    public function generate_bilan($projet)
    {
        // recuperer les projets et les afficher dans le pdf
        $projets = Projet::where('id', $this->$projet);
        dd($projets);
        // récuperer les activités de chaque projet et les afficher dans le pdf
        // $projets = Projet::all()->where('id', 1)->with('activites');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('Bilans.bilan_pdf', compact('projets'));
        return $pdf->stream();

    }

}
