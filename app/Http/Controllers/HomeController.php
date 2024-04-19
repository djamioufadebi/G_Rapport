<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Besoin;
use App\Models\Projet;
use App\Models\Rapport;
use App\Models\Activite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $user_id = $user->id;
        $dateToday = Carbon::now();

        $dateBefore = Carbon::now()->subDays(3)->startOfDay();

        $projectCount = Projet::count();
        $encoursProjectCount = Projet::where('date_debut', '<=', $dateToday)
                ->where('date_fin_prevue', '>=', $dateToday)
                ->where('statut', '=', 'en cours')->count();


        $activityCount = Activite::count();
        $encoursActivityCount = Activite::where('date_debut', '<=', $dateToday)
                ->where('date_fin', '>=', $dateToday)
                ->where('statut', '=', 'en cours')->count();


        $reportCount = Rapport::count();
        $dayReportCount = Rapport::whereBetween(
                'created_at',
                [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
                ->orwhere('updated_at', $dateToday)->count();


        $besoinCount = Besoin::count();
        $dayBesoinCount = Besoin::whereBetween(
                'created_at',
                [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()]
            )->orwhere('updated_at', $dateToday)->count();

        $userCount = User::count();
        $newsUser = User::whereBetween('created_at', [$dateBefore, $dateToday])->count();

        return view('home', compact('projectCount', 'userCount',
        'dayBesoinCount', 'dayReportCount', 
        'newsUser', 'encoursProjectCount', 
        'encoursActivityCount' ,'userCount', 'besoinCount', 
        'activityCount', 'reportCount'));
    }
}