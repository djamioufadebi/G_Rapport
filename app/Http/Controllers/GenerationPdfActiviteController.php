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

    public $selectedActiviteId;
    public function generateActivitepdfBilan()
    {
        $idActiviteChoisie = $this->selectedActiviteId;
        dd($idActiviteChoisie);

        $activites = Activite::find($this->selectedActiviteId)->first();

        $dateToday = Carbon::now();
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