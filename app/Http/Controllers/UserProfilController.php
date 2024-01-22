<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfilController extends Controller
{
    public function profil()
    {
        $user = Auth()->user()->id;
        return view('Auth.profil', compact('user'));
    }

    public function update(Request $request)
    {
        // recupération de l'utilisateur en cours de session
        $user = User::where('id', auth()->user()->id)->first();

        // Vérification du mot de passe ancien et du nouveau mot de passe (si ils sont remplis)
        $chekpassword = Hash::check($request->input('old_password'), Auth::user()->password);
        if ($chekpassword == FALSE) {
            return redirect()->route('mon_profile')->with('error', ['title' => 'Erreur MDP!', 'message' => 'Mot de passe incorrect']);
        }
        // Vérification du nouveau mot de passe (si ils sont remplis) et du mot de passe actuel (si ils sont remplis)
        else {
            if (($request->input('new_password') != null) and ($request->input('new_password_confirmation') != null)) {
                if ($request->input('new_password') == $request->input('new_password_confirmation')) {
                    $user->password = Hash::make($request->input('new_password'));
                    //$user->nom = $request->input('nom');
                    // $user->prenom = $request->input('prenom');
                    // $user->email = $request->input('email');
                    $user->save();
                    return redirect()->route('mon_profile')->with('success', 'Votre mot de passe a été modifié avec succès');
                } else {
                    return redirect()->route('mon_profile')->with(
                        'error',
                        ['title' => 'Erreur de confirmation!', 'message' => 'Les mots de passe ne sont pas identiques.']
                    );
                }
            }
            return redirect()->route('mon_profile')->with(
                'success',
                ['title' => 'Edition du profil!', 'message' => 'Votre profil est mise à jour avec succès.']
            );
        }

    }

    public function passwordchange()
    {
        return view('Auth.passwordchange');
    }

    public function changePassword(Request $request)
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Valider les données du formulaire
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).+$/',
            ],
            'new_password_confirmation' => 'required|min:8|same:new_password',
        ]);

        // Vérifier si le mot de passe actuel est correct
        $isPasswordCorrect = Hash::check($request->input('current_password'), $user->password);

        if (!$isPasswordCorrect) {
            return redirect()->route('mon-profile')->with('error', 'Mot de passe incorrect');
        } else {
            // Mettre à jour le mot de passe si le nouveau mot de passe est fourni
            if ($request->input('new_password') != null and ($request->input('new_password_confirmation') != null)) {
                if ($request->input('new_password') == $request->input('new_password_confirmation')) {
                    $user->password = Hash::make($request->input('new_password'));
                    $user->save();
                    return redirect()->route('password.change')->with('success', 'vous avez changé votre mot de passe');
                } else {
                    return redirect()->route('password.change')->with('error', 'Les mots de passes ne sont pas identiques');
                }
            } else {
                return redirect()->route('password.change')->with('error', 'Le nouveau mot de passe ne peut pas être vide');
            }
        }


    }


}