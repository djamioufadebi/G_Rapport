<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Projet;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Intervenant;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IntervenantController extends Controller
{

    public function index()
    {
        if (Gate::allows('viewliste', Intervenant::class)) {
            return view('intervenants.liste');
        } else {
            return view('composants.redirection-new-user'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function create()
    {
        if (Gate::allows('create', Intervenant::class)) {
            return view('intervenants.create');
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function edit(Intervenant $intervenant)
    {
        if (Gate::allows('edit', $intervenant)) {
            return view('intervenants.edit', compact('intervenant'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function show(Intervenant $intervenant)
    {
        if (Gate::allows('view', $intervenant)) {
            return view('intervenants.show', compact('intervenant'));
        } else {
            return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
        }
    }

    public function pdfIntervenant()
    {
        $dateToday = Carbon::now();
        $user = Auth::user();
        if ($user->id_profil == 1) {
            $intervenants = Intervenant::all();
            // $data = ['title' => 'Liste des utilisateurs'];
            $pdf = Pdf::loadView('PDF.intervenants_pdf', compact('intervenants', 'dateToday'));
            // return $pdf->download('liste_des_utilisateurs.pdf');
            return $pdf->stream();
        } else {
            $projets = Projet::where('id_gestionnaire', '=', $user->id)->get();
            // Extraire uniquement les IDs des projets
            $idsProjetsUser = $projets->pluck('id')->toArray();
            // Récupérer les activités dont le champ 'id_projet' est parmi les IDs extraits
            $listeActivites = Activite::whereIn('id_projet', $idsProjetsUser)->get();
            $idsActivitesUser = $listeActivites->pluck('id')->toArray();
            // les intervenants dont les champs "id_activite" est parmi les ID extraits
            $intervenants = Intervenant::whereIn('id_activite', $idsActivitesUser)->get();
            // $data = ['title' => 'Liste des utilisateurs'];
            $pdf = Pdf::loadView('PDF.intervenants_pdf', compact('intervenants', 'dateToday'));
            // return $pdf->download('liste_des_utilisateurs.pdf');
            return $pdf->stream();

        }
    }

}