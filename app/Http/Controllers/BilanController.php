<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Besoin;
use App\Models\Bilan;
use App\Models\Projet;
use App\Models\Rapport;
use App\Models\User;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BilanController extends Controller
{


    public function index(Bilan $bilan)
    {
        return view('Bilans.bilan', compact('bilan'));
    }

    public function generateBilan()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $dateToday = Carbon::now();

        if ($user->id_profil == 1) {

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
            )->orwhere('updated_at', $dateToday)->get();

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
            )->orwhere('updated_at', $dateToday)->get();


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
            // Spécifier le nom du fichier PDF pour les navigateurs intégrés
            $filename = 'Bilan_journalier_du : ' . now()->format('Y-m-d') . '.pdf';

            // Télécharger le fichier avec le nom spécifié
            //return $pdf->download($filename);
            // Ouvrir le PDF dans le navigateur avec le nom spécifié

            return $pdf->stream($filename, ['Attachment' => false]);
            //return $pdf->stream();

        } else {

            // 1  :  Pour les projet en cours
            // Récupérer les projets de l'utilisateur qui son en cours
            $projetsEnCoursAujourdhui = Projet::where('id_gestionnaire', '=', $user_id)
                ->where('date_debut', '<=', $dateToday)
                ->where('date_fin_prevue', '>=', $dateToday)
                ->where('statut', '=', 'en cours')->get();

            // Récupérer les projets de l'utilisateur qui son en attente
            $projetEnAttenteAjourdhui = Projet::where('id_gestionnaire', '=', $user_id)
                ->where('date_debut', '>', $dateToday)
                ->where('date_fin_prevue', '>', $dateToday)
                ->where('statut', '=', 'en attente')->get();

            // Pour les activités en cours de l'utilisateur
            // Extraire uniquement les IDs des projets
            $idsProjetsEncours = $projetsEnCoursAujourdhui->pluck('id')->toArray();
            // Récupérer les activités dont le champ 'id_projet' est parmi les IDs extraits
            $activitesEnCours = Activite::whereIn('id_projet', $idsProjetsEncours)
                ->where('date_debut', '<=', $dateToday)
                ->where('date_fin', '>=', $dateToday)
                ->where('statut', '=', 'en cours')->get();

            // Pour les activites en attentes de l'utilisateur
            // Extraire uniquement les IDs des projets
            $idsProjetsEnAttentes = $projetEnAttenteAjourdhui->pluck('id')->toArray();
            // Récupérer les activités en attentes dont le champ 'id_projet' est parmi les IDs extraits
            $activitesEnAttentes = Activite::whereIn('id_projet', $idsProjetsEnAttentes)
                ->where('date_debut', '>', $dateToday)
                ->where('date_fin', '>', $dateToday)
                ->where('statut', '=', 'en cours')->get();

            $projetsTerminesAujourdhui = Projet::where('id_gestionnaire', '=', $user_id)
                ->where('date_fin_prevue', '<=', $dateToday)
                ->where('statut', '=', 'terminé')->get();

            $activitesTermineesAjourdhui = Activite::whereIn('id_projet', $idsProjetsEncours)
                ->where('date_fin', '<=', $dateToday)
                ->where('statut', '=', 'terminé')->get();

            //  Extraire uniquement les IDs des activités en cours
            $idsActiviteEncours = $activitesEnCours->pluck('id')->toArray();

            $rapportsCreesAujourdhui = Rapport::whereIn('id_activite', $idsActiviteEncours)
                ->whereBetween(
                    'created_at',
                    [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
                )->orwhere('updated_at', $dateToday)->get();

            $besoinsEnCoursAujourdhui = Besoin::whereIn('id_activite', $idsActiviteEncours)
                ->whereBetween(
                    'created_at',
                    [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
                )->orwhere('updated_at', $dateToday)->get();

            $pdf = Pdf::loadView(
                'Bilans.bilan_journalier_gestionnaire',
                compact(
                    'dateToday',
                    'activitesEnCours',
                    'activitesEnAttentes',
                    'projetEnAttenteAjourdhui',
                    'projetsEnCoursAujourdhui',
                    'rapportsCreesAujourdhui',

                    'activitesTermineesAjourdhui',
                    'projetsTerminesAujourdhui',
                    'besoinsEnCoursAujourdhui'
                )
            );
            $pdf->setPaper('a4', 'landscape');
            // Spécifier le nom du fichier PDF pour les navigateurs intégrés
            $filename = 'Bilan_journalier_' . now()->format('Y-m-d') . '.pdf';

            // Télécharger le fichier avec le nom spécifié
            //return $pdf->download($filename);
            // Ouvrir le PDF dans le navigateur avec le nom spécifié

            return $pdf->stream($filename, ['Attachment' => false]);
            //return $pdf->stream();

        }

    }

}