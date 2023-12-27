<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user) {
            if ($user->profil()->pluck('nom')->contains('Administrateur')) {
                return route('profils'); // Rediriger vers le tableau de bord pour les administrateurs
            } elseif ($user->profil()->pluck('nom')->contains('Gestionnaire')) {
                return route('projets'); // Rediriger vers le tableau de bord du profil 2
            } elseif ($user->profil()->pluck('nom')->contains('Chef chantier')) {
                return route('besoins'); // Rediriger vers le tableau de bord du profil 3
            } elseif ($user->profil()->pluck('nom')->contains('Manager')) {
                return route('home'); // Rediriger vers le tableau de bord du profil 4
            } elseif ($user->profil()->pluck('nom')->contains('Magasinier')) {
                return route('rapports'); // Rediriger vers le tableau de bord du profil 4
            } else {
                return view('composants.redirection-new-user');
            }
        } else {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
            return route('login');
        }
    }

}
