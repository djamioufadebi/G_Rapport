<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Besoin;
use App\Models\Bilan;
use App\Models\Projet;
use App\Models\Rapport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BilanController extends Controller
{

    public function index(Bilan $bilan)
    {
        return view('Bilans.bilan', compact('bilan'));
    }

    public function create()
    {
        //return view('Bilans.bilan-journalier');
    }

    public function generateBilan()
    {

        $dateToday = Carbon::today();

        // Récupérer les projets en cours aujourd'hui
        $projetsEnCoursAujourdhui = Projet::where('date_debut', '<=', $dateToday)
            ->where('date_fin_prevue', '>=', $dateToday)
            ->where('statut', '=', 'en cours')
            ->get();

        // Récupérer les projets en attentes aujourd'hui
        $projetEnAttenteAjourdhui = Projet::where('statut', '=', 'en attente')
            ->get();


        // Récupérer les rapports créés aujourd'hui
        $rapportsCreesAujourdhui = Rapport::whereDate('created_at', $dateToday)->orwhere('updated_at', $dateToday)->get();

        // Récupérer les besoins en cours aujourd'hui

        $besoinsEnCoursAujourdhui = Besoin::whereBetween(
            'created_at',
            [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
        )
            ->orwhere('updated_at', $dateToday)->get();

        // récupérer les besoins qui ont été crés aujourdhui
        // $besoinsEnCoursAujourdhui = Besoin::where('statut', 'en cours')->get();

        $activitesEnCours = Activite::where('statut', '=', 'en cours')->get();

        $activitesEnAttentes = Activite::where('statut', '=', 'en attente')->get();


        $activitesEnCoursTerminees = Activite::where('statut', '=', 'terminé')->get();

        // récupérer les rapports créés aujourd'hui
        $rapportsCreesAujourdhui = Rapport::whereBetween(
            'created_at',
            [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
        )
            ->orwhere('updated_at', $dateToday)->get();


        $pdf = Pdf::loadView(
            'Bilans.bilan-journalier',
            compact(
                'activitesEnAttentes',
                'activitesEnCoursTerminees',
                'dateToday',
                'rapportsCreesAujourdhui',
                'activitesEnCours',
                'projetEnAttenteAjourdhui',
                'projetsEnCoursAujourdhui',
                'besoinsEnCoursAujourdhui'
            )
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();

    }

}