<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Projet;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ActiviteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    if (Gate::allows('viewliste', Activite::class)) {
      return view('Activites.liste');
    } else {
      return view('composants.redirection-new-user'); // Redirection vers une vue indiquant un accès refusé
    }

  }

  public function create()
  {
    // politique d'autorisation définie dans la page de Policy permettant de refuser l'accès à la page d'ajout d'activité si l'utilisateur n'a pas un bon profil
    if (Gate::allows('create', Activite::class)) {
      return view('Activites.create');
    } else {
      return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
    }
  }

  public function edit(Activite $activite)
  {
    // politique d'autorisation définie dans la page de Policy
    //$this->authorize('edit', $activite);
    if (Gate::allows('edit', $activite)) {
      return view('Activites.edit', compact('activite'));
    } else {
      return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
    }
  }

  public function show(Activite $activite)
  {
    if (Gate::allows('view', $activite)) {
      return view('Activites.show', compact('activite'));
    } else {
      return view('composants.acces_refuser'); // Redirection vers une vue indiquant un accès refusé
    }
  }

  public function pdfActivite()
  {
    $user = Auth::user();
    if ($user->id_profil == 1 || $user->id_profil == 2 || $user->id_profil == 3) {
      $activites = Activite::all();
      $dateToday = Carbon::now();
      // $data = ['title' => 'Liste des utilisateurs'];
      $pdf = Pdf::loadView('PDF.activites_pdf', compact('activites', 'dateToday'));
      // return $pdf->download('liste_des_utilisateurs.pdf');
      return $pdf->stream();
    } else {
      $projets = Projet::where('id_gestionnaire', '=', $user->id)->get();
      // Extraire uniquement les IDs des projets
      $idsProjetsUser = $projets->pluck('id')->toArray();
      // Récupérer les activités dont le champ 'id_projet' est parmi les IDs extraits
      $listeActivites = Activite::whereIn('id_projet', $idsProjetsUser)->get();
      $pdf = Pdf::loadView('PDF.activites_pdf', compact('activites', 'dateToday'));
      // return $pdf->download('liste_des_utilisateurs.pdf');
      return $pdf->stream();
    }

  }

}
