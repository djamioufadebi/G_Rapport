<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Besoin;
use App\Models\Bilan;
use App\Models\Projet;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BilanController extends Controller
{

    public function index(Bilan $bilan)
    {
        return view('Bilans.bilan', compact('bilan'));
    }

    public function generateBilan()
    {
        // recuperer le user et les afficher dans le pdf
        $user = User::all();
        dd($user);
        $pdf = Pdf::loadView('Bilans.bilan_pdf', compact('user'));
        return $pdf->stream();

    }

}
