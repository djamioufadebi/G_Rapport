<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Besoin;
use App\Models\Projet;
use App\Models\Rapport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GenerationPdfActiviteController extends Controller
{
    public function generateActivitepdfBilan(Request $request)
    {
        $request->id_activite;

        $idActiviteChoisie = $request->id_activite;


        $activites = Activite::find($idActiviteChoisie);


        $dateToday = Carbon::now();
        // Récupérer le rapport de l'activité en cours
        $rapportsSelectedActivity = Rapport::where('id_activite', '=', $idActiviteChoisie)
            ->whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            ->orwhere('updated_at', $dateToday)->get();

        // récupérer les besoins de l'activité selectionnée
        $besoins = Besoin::where('id_activite', $idActiviteChoisie)->whereBetween(
            'created_at',
            [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
        )->orwhere('updated_at', $dateToday)->get();

        $pdf = Pdf::loadView(
            'Bilans.bilan-activite',
            compact(
                'dateToday',
                'activites',
                'besoins',
                'rapportsSelectedActivity'
            )
        );
        $pdf->setPaper('a4', 'landscape');
        // Spécifier le nom du fichier PDF pour les navigateurs intégrés
        $filename = 'Bilan_activite_' . now()->format('Y-m-d') . '.pdf';

        // Télécharger le fichier avec le nom spécifié
        //return $pdf->download($filename);
        // Ouvrir le PDF dans le navigateur avec le nom spécifié

        return $pdf->stream($filename, ['Attachment' => false]);
        //return $pdf->stream();
    }

}
