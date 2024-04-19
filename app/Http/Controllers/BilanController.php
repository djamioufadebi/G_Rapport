<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Besoin;
use App\Models\Bilan;
use App\Models\Intervenant;
use App\Models\Projet;
use App\Models\Rapport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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
            //  Extraire uniquement les IDs des activités en cours
            $idsActiviteEncours = $activitesEnCours->pluck('id')->toArray();

            // récupérer les intervenants sur chaque activité en cours
            // $intervenants = Intervenant::whereIn('id_activite', $idsActiviteEncours)->get();

            // compter le nombre de ces intervenants
            //  $nbIntervenants = $intervenants->count();

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
            //$pdf->setPaper('a4', 'landscape');
            $pdf->setPaper([0, 0, 800, 1200]);
            // Spécifier le nom du fichier PDF pour les navigateurs intégrés
            $filename = 'Bilan_global_du_jour : ' . now()->format('Y-m-d') . '.pdf';

            // Télécharger le fichier avec le nom spécifié
            //return $pdf->download($filename);
            // Ouvrir le PDF dans le navigateur avec le nom spécifié

            return $pdf->stream($filename, ['Attachment' => false]);
            //return $pdf->stream();

        } else {

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

            // récupérer les intervenants sur chaque activité en cours
            //$intervenants = Intervenant::whereIn('id_activite', $idsActiviteEncours)->get();

            // compter le nombre de ces intervenants
            //$nbIntervenants = $intervenants->count();

            $rapportsCreesAujourdhui = Rapport::where('user_id', $user_id)
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
            //$pdf->setPaper([0, 0, 800, 1200]);
            // Spécifier le nom du fichier PDF pour les navigateurs intégrés
            $filename = 'Bilan_global_du_jour : ' . now()->format('Y-m-d') . '.pdf';

            // Télécharger le fichier avec le nom spécifié
            //return $pdf->download($filename);
            // Ouvrir le PDF dans le navigateur avec le nom spécifié

            return $pdf->stream($filename, ['Attachment' => false]);
            // return $pdf->stream();

        }

    }

    public function generateActivitepdfBilan(Request $request)
    {
        $request->id_activite;

        $idActiviteChoisie = $request->id_activite;


        $activites = Activite::where('id', '=', $idActiviteChoisie)->get();

        // récuperer les intervenants qui ont intervenant sur cette activité et les compter
        $intervenants = Intervenant::where('id_activite', '=', $idActiviteChoisie)->get();

        // compter le nombre de ces intervenants
        $nbIntervenants = $intervenants->count();

        $dateToday = Carbon::now();

        $rapportsSelectedActivity = Rapport::where('id_activite', $idActiviteChoisie)
            ->whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            ->orWhere('updated_at', '>=', $dateToday)
            ->get();

        // récupérer les besoins de l'activité selectionnée
        $besoins = Besoin::where('id_activite', $idActiviteChoisie)->whereBetween(
            'created_at',
            [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
        )->orwhere('updated_at', $dateToday)->get();



        $pdf = Pdf::loadView(
            'Bilans.bilan-activite',
            compact(
                'dateToday',
                'rapportsSelectedActivity',
                'intervenants',
                'nbIntervenants',
                'activites',
                'besoins'
            )
        );
        $pdf->setPaper('a4', 'landscape');
        // Spécifier le nom du fichier PDF pour les navigateurs intégrés
        $filename = 'Bilan_activite' . now()->format('Y-m-d') . '.pdf';

        // Télécharger le fichier avec le nom spécifié
        //return $pdf->download($filename);
        // Ouvrir le PDF dans le navigateur avec le nom spécifié

        //return $pdf->download();
        return $pdf->stream($filename, ['Attachment' => false]);
        // return $pdf->stream();
    }

    public $selectedProjetId;
    public function generateProjetBilan(Request $request)
    {


        $ProjetId = $request->id_projet;

        $user = Auth::user();
        $user_id = $user->id;
        $dateToday = Carbon::now();

        if ($user->id_profil == 1) {
            $projets = Projet::where('id', '=', $ProjetId)->get();

            // Récupérer tous les activités de ce projet
            $activites = Activite::where('id_projet', '=', $ProjetId);


            // Récupérer les id des activités de ce projet
            $idsActivitesselectedProjet = $activites->pluck('id')->toArray();

            // recupérer les rapports des activités de ce projet créés aujourd'hui
            $rapportsCreesAujourdhui = Rapport::whereIn('id_activite', $idsActivitesselectedProjet)
                ->whereBetween(
                    'created_at',
                    [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
                )->orwhere('updated_at', $dateToday)->get();

            // recupérer les besoins des activités de ce projet créés aujourd'hui
            $besoinsEnCoursAujourdhui = Besoin::whereIn('id_activite', $idsActivitesselectedProjet)
                ->whereBetween(
                    'created_at',
                    [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
                )->orwhere('updated_at', $dateToday)->get();


            // Récupérer les activités de ce projet en cours
            $activitesEnCours = Activite::whereIn('id', $idsActivitesselectedProjet)
                ->where('date_debut', '<=', $dateToday)
                ->where('date_fin', '>=', $dateToday)
                ->where('statut', '=', 'en cours')->get();

            // Récupérer les activités de ce projet en attentes
            $activitesEnAttentes = Activite::whereIn('id', $idsActivitesselectedProjet)
                ->where('date_debut', '>', $dateToday)
                ->where('date_fin', '>', $dateToday)
                ->where('statut', '=', 'en attente')->get();


            $pdf = Pdf::loadView(
                'Bilans.bilan_projet',
                compact(
                    'dateToday',
                    'activites',
                    'projets',
                    'activitesEnCours',
                    'activitesEnAttentes',
                    'rapportsCreesAujourdhui',
                    'besoinsEnCoursAujourdhui'
                )
            );
            $pdf->setPaper('a4', 'landscape');
            // Spécifier le nom du fichier PDF pour les navigateurs intégrés
            $filename = 'Bilan_projet_' . now()->format('Y-m-d') . '.pdf';

            // Télécharger le fichier avec le nom spécifié
            //return $pdf->download($filename);
            // Ouvrir le PDF dans le navigateur avec le nom spécifié

            return $pdf->stream($filename, ['Attachment' => false]);
            //return $pdf->stream();

        } else {

            $projets = Projet::where('id', '=', $ProjetId)->where('id_gestionnaire', '=', $user_id)
                ->get();

            $activites = Activite::where('id_projet', '=', $ProjetId)->get();
            // Récupérer les id des activités de ce projet
            $idsActivitesselectedProjet = $activites->pluck('id')->toArray();

            // recupérer les rapports des activités de ce projet créés aujourd'hui
            $rapportsCreesAujourdhui = Rapport::whereIn('id_activite', $idsActivitesselectedProjet)
                ->whereBetween(
                    'created_at',
                    [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
                )->orwhere('updated_at', $dateToday)->get();

            // recupérer les besoins des activités de ce projet créés aujourd'hui
            $besoinsEnCoursAujourdhui = Besoin::whereIn('id_activite', $idsActivitesselectedProjet)
                ->whereBetween(
                    'created_at',
                    [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
                )->orwhere('updated_at', $dateToday)->get();

            // Récupérer les activités de ce projet en cours
            $activitesEnCours = Activite::whereIn('id', $idsActivitesselectedProjet)
                ->where('date_debut', '<=', $dateToday)
                ->where('date_fin', '>=', $dateToday)
                ->where('statut', '=', 'en cours')->get();
            // Récupérer les activités de ce projet en attentes
            $activitesEnAttentes = Activite::whereIn('id', $idsActivitesselectedProjet)
                ->where('date_debut', '>', $dateToday)
                ->where('date_fin', '>', $dateToday)
                ->where('statut', '=', 'en attente')->get();

            $pdf = Pdf::loadView(
                'Bilans.bilan_projet',
                compact(
                    'dateToday',
                    'activites',
                    'projets',
                    'activitesEnCours',
                    'activitesEnAttentes',
                    'rapportsCreesAujourdhui',
                    'besoinsEnCoursAujourdhui'
                )
            );

            $pdf->setPaper('a4', 'landscape');
            // Spécifier le nom du fichier PDF pour les navigateurs intégrés
            $filename = 'Bilan_projet_' . now()->format('Y-m-d') . '.pdf';

            // Télécharger le fichier avec le nom spécifié
            //return $pdf->download($filename);
            // Ouvrir le PDF dans le navigateur avec le nom spécifié

            return $pdf->stream($filename, ['Attachment' => false]);
            //return $pdf->stream();

        }

    }

    public $selectedDatedebut;
    public $selectedDatefin;

    public function generatePeriodeBilan(Request $request)
    {
        $projetID = $request->id_projet;
        $dateDebut = $request->date_debut;
        $dateFin = $request->date_fin;

        $user = Auth::user();
        $user_id = $user->id;
        $dateToday = Carbon::now();

        if ($user->id_profil == 1) {

            $projets = Projet::where('id', '=', $projetID)->get();
            // Récupérer tous les activités de ce projet
            $activites = Activite::where('id_projet', '=', $projetID)->get();
            // Récupérer les id des activités de ce projet
            $idsActivitesselectedProjet = $activites->pluck('id')->toArray();
            // récupérer les rapports des activités de ce projet créés entres les deux dates (dateDebut et dateFin)
            $rapportsCreesAujourdhui = Rapport::whereIn('id_activite', $idsActivitesselectedProjet)
                ->whereBetween(
                    'created_at',
                    [$dateDebut, $dateFin]
                )->orwhere('updated_at', $dateToday)->get();

            // récupérer les besoins des activités de ce projet créés entres les deux dates (dateDebut et dateFin)
            $besoinsEnCoursAujourdhui = Besoin::whereIn('id_activite', $idsActivitesselectedProjet)
                ->whereBetween(
                    'created_at',
                    [$dateDebut, $dateFin]
                )->orwhere('updated_at', $dateToday)->get();
            // Récupérer les activités de ce projet en cours
            $activitesEnCours = Activite::whereIn('id', $idsActivitesselectedProjet)
                ->where('date_debut', '<=', $dateFin)
                ->where('date_fin', '>=', $dateFin)
                ->where('statut', '=', 'en cours')->get();
            // Récupérer les activités de ce projet en attentes
            $activitesEnAttentes = Activite::whereIn('id', $idsActivitesselectedProjet)
                ->where('date_debut', '>', $dateFin)
                ->where('date_fin', '>', $dateFin)
                ->where('statut', '=', 'en attente')->get();

            $pdf = Pdf::loadView(
                'Bilans.bilan_periode',
                compact(
                    'dateToday',
                    'dateDebut',
                    'dateFin',
                    'projets',
                    'activitesEnCours',
                    'activitesEnAttentes',
                    'rapportsCreesAujourdhui',
                    'besoinsEnCoursAujourdhui'
                )
            );

            $pdf->setPaper('a4', 'landscape');
            // Nom : Bilan de la période + dateDebut + dateFin
            //$filename = 'Bilan de la période'. $dateDebut.'- '. $dateFin.'- '. $projetID. '.pdf';
            $filename = 'Bilan_periode_' . $dateDebut . '_' . $dateFin . '.pdf';

            return $pdf->stream($filename, ['Attachment' => false]);


        } else {
            $projets = Projet::where('id', '=', $projetID)->where('id_gestionnaire', '=', $user->id)->get();
            // Récupérer tous les activités de ce projet
            $activites = Activite::where('id_projet', '=', $projetID)->get();
            // Récupérer les id des activités de ce projet
            $idsActivitesselectedProjet = $activites->pluck('id')->toArray();
            // récupérer les rapports des activités de ce projet créés entres les deux dates (dateDebut et dateFin)
            $rapportsCreesAujourdhui = Rapport::whereIn('id_activite', $idsActivitesselectedProjet)
                ->whereBetween(
                    'created_at',
                    [$dateDebut, $dateFin]
                )->orwhere('updated_at', $dateToday)->get();
            // récupérer les besoins des activités de ce projet créés entres les deux dates (dateDebut et dateFin)
            $besoinsEnCoursAujourdhui = Besoin::whereIn('id_activite', $idsActivitesselectedProjet)
                ->whereBetween(
                    'created_at',
                    [$dateDebut, $dateFin]
                )->orwhere('updated_at', $dateToday)->get();

            // Récupérer les activités de ce projet en cours
            $activitesEnCours = Activite::whereIn('id', $idsActivitesselectedProjet)
                ->where('date_debut', '<=', $dateFin)
                ->where('date_fin', '>=', $dateFin)
                ->where('statut', '=', 'en cours')->get();

            // Récupérer les activités de ce projet en attentes
            $activitesEnAttentes = Activite::whereIn('id', $idsActivitesselectedProjet)
                ->where('date_debut', '>', $dateFin)
                ->where('date_fin', '>', $dateFin)
                ->where('statut', '=', 'en attente')->get();



            $pdf = Pdf::loadView(
                'Bilans.bilan_periode',
                compact(
                    'dateToday',
                    'projets',
                    'dateDebut',
                    'dateFin',
                    'activitesEnCours',
                    'activitesEnAttentes',
                    'rapportsCreesAujourdhui',
                    'besoinsEnCoursAujourdhui'
                )
            );

            $pdf->setPaper('a4', 'landscape');
            // Nom : Bilan de la période + dateDebut + dateFin
            //$filename = 'Bilan de la période'. $dateDebut.'- '. $dateFin.'- '. $projetID. '.pdf';
            $filename = 'Bilan_periode_' . $dateDebut . '_' . $dateFin . '.pdf';

            return $pdf->stream($filename, ['Attachment' => false]);

        }

    }

}
