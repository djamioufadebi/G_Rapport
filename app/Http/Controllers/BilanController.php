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

    public $id_activite;
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

        $dateToday = Carbon::now();

        //$Tomorrow = $dateToday->addDay();

        // Récupérer les projets en cours aujourd'hui
        $projetsEnCoursAujourdhui = Projet::where('date_debut', '<=', $dateToday)
            ->where('date_fin_prevue', '>=', $dateToday)
            ->where('statut', '=', 'en cours')
            ->get();



        $projetEnAttenteAjourdhui = Projet::where('date_debut', '>', $dateToday)
            ->where('date_fin_prevue', '>', $dateToday)
            ->where('statut', '=', 'en attente')
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
        // $activiteTermineAujourdhui = Activite::where('statut','=', 'arrêté')->get();

        $activitesEnCours = Activite::where('date_debut', '<=', $dateToday)
            ->where('date_fin', '>=', $dateToday)
            ->where('statut', '=', 'en cours')->get();

        $activitesEnAttentes = Activite::where('date_debut', '>', $dateToday)
            ->where('date_fin', '>', $dateToday)
            ->where('statut', '=', 'en attente')->get();

        // récupérer les activités terminées aujourd'hui
        $activitesTermineesAjourdhui = Activite::where('date_fin', '<=', $dateToday)
            ->where('statut', '=', 'terminé')->get();

        // récupérer les projets terminés aujourdhui
        $projetsTerminesAujourdhui = Projet::where('date_fin_prevue', '<=', $dateToday)
            ->where('statut', '=', 'terminé')->get();

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
                'activitesTermineesAjourdhui',
                'dateToday',
                'rapportsCreesAujourdhui',
                'activitesEnCours',
                'projetEnAttenteAjourdhui',
                'projetsEnCoursAujourdhui',
                'besoinsEnCoursAujourdhui',
                'projetsTerminesAujourdhui',
                'activitesTermineesAjourdhui'
            )
        );
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function generateActiviteBilan()
    {
        $dateToday = Carbon::now();

        $activites = Activite::findOrFail($this->id_activite)->get();
        // Récupérer le rapport de l'activité en cours
        $rapportsSelectedActivity = Rapport::where('id_activite', $activites->id)
            ->whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            ->orwhere('updated_at', $dateToday)->get();

        // récupérer les besoins de l'activité selectionnée
        $besoins = Besoin::where('id_activite', $activites->id)->whereBetween(
            'created_at',
            [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
        )->orwhere('updated_at', $dateToday)->get();

        // récuperer le projet de l'activité sélectionnée
        $projet = Projet::where('id', $activites->id_projet)->get();

        $pdf = Pdf::loadView(
            'Bilans.bilan-activite',
            compact(
                'activites',
                'projet',
                'besoins',
                'rapportsSelectedActivity'
            )
        );
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

}