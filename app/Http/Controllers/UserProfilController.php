<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfilController extends Controller
{
    public function profil()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('Auth.profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        $chekpassword = Hash::check($request->input('old_password'), Auth::user()->password);
        if ($chekpassword == FALSE) {
            return redirect()->route('mon-profile')->with('error', ['title' => 'Erreur MDP!', 'message' => 'Mot de passe incorrect']);
        } else {
            if (($request->input('new_password') != null) and ($request->input('confirmation_new_password') != null)) {
                if ($request->input('new_password') == $request->input('confirmation_new_password')) {
                    $user->password = Hash::make($request->input('new_password'));
                    $user->save();
                    //return redirect()->route('mon-profile')->with('success', 'Votre mot de passe a été modifié avec succès');
                } else {
                    return redirect()->route('mon-profile')->with(
                        'error',
                        ['title' => 'Erreur de confirmation!', 'message' => 'Les mots de passe ne sont pas identiques.']
                    );
                }
            }

            $user->nom = $request->input('nom');
            $user->prenom = $request->input('prenom');
            $user->email = $request->input('email');
            $user->update();

            return redirect()->route('mon-profile')->with(
                'success',
                ['title' => 'Edition du profil!', 'message' => 'Votre profil est mise à jour avec succès.']
            );
        }

    }

}