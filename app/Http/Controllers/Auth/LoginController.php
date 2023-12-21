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
            switch ($user->id_profil) {
                case 1:
                    return route('users'); // Rediriger vers le tableau de bord du profil 1

                case 2:
                    // Rediriger vers le tableau de bord du profil 2
                    return route('besoins');

                case 3:
                    // Rediriger vers le tableau de bord du profil 2
                    return route('projets');
                case 4:
                    // Rediriger vers le tableau de bord du profil 2
                    return route('activites');
                case 5:
                    // Rediriger vers le tableau de bord du profil 2
                    return view('composants.redirection-new-user');
                case 6:
                    // Rediriger vers le tableau de bord du profil 2
                    return route('besoins');
                default:
                    // si l'utilisateur n'est pas au bon rôle, on lui donne un message d'erreur
                    abort(403, 'Vous n\'avez pas le profil pour accéder à cette page');
                //return route('home'); // Rediriger vers une page par défaut si le profil n'est pas spécifié
            }
        } else {
            return route('login'); // Rediriger vers la page de connexion si l'utilisateur n'est pas authentifié
        }
    }

}