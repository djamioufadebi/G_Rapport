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
        return view('Bilans.bilan-journalier');
    }

    public function generateBilan()
    {

        $dateToday = Carbon::today();

        // Récupérer les projets en cours aujourd'hui
        //$projetsEnCoursAujourdhui = Projet::whereDate('date_debut', '<=', $dateToday)
        //   ->whereDate('date_fin_prevue', '>=', $dateToday)->where('statut', 'en cours')
        //   ->get();

        $projetsEnCoursAujourdhui = Projet::where('statut', 'en cours');

        //$projetsEnCoursAujourdhui = Projet::where('id', '!=', 1)->get();
        //dd($projetsEnCoursAujourdhui);

        // Récupérer les rapports créés aujourd'hui
        $rapportsEnCoursAujourdhui = Rapport::whereDate('created_at', $dateToday)->get();

        $projetsEnAttente = Projet::where('statut', 'en cours')->get();
        //dd($projetsEnAttente);

        // les activités en cours
        $activitesEnCours = Activite::whereDate('date_debut', '<=', $dateToday)
            ->whereDate('date_fin', '>=', $dateToday)->where('statut', 'en attente')
            ->get();
        $activitesEnCours = Activite::where('statut', 'en attente')->get();
        //dd($activitesEnCours);

        // récupérer les rapports créés aujourd'hui et les afficher dans le pdf
        //$rapports = Rapport::whereDate('created_at', Carbon::today())->get();
        $rapports = Rapport::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->get();


        $pdf = Pdf::loadView('Bilans.bilan-journalier', compact('rapportsEnCoursAujourdhui', 'rapports', 'activitesEnCours', 'projetsEnAttente', 'projetsEnCoursAujourdhui'));

        // Changer la disposition en mode paysage
        //$pdf->setPaper('a4', 'landscape');
        //  $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        return $pdf->stream();

    }

}
