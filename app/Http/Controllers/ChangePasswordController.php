<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{

    public function index()
    {
        return view('Auth.passwordchange');
    }

    public function changePassword(Request $request)
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Valider les données du formulaire
        $validator = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).+$/',
        ]);

        // Vérifier si le mot de passe actuel est correct
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->route('password.change')->with('error', 'Mot de passe incorrect');
        } else if ($request->filled('new_password')) {
            $user->update(['password' => bcrypt($request->input('new_password'))]);
            return redirect()->route('password.change')->with('success', 'Vous avez changé votre mot de passe');
        } else {
            return redirect()->route('password.change')->withErrors($validator)->with('error', 'Le nouveau mot de passe ne peut pas être vide');
        }

    }

}