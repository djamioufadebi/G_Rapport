<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{

    public function index()
    {
        return view('Auth.passwordchange');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'different:current_password',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).+$/',

            ],

            'password_confirmation' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Le champ du mot de passe actuel est requis',
            'new_password.different' => 'Le nouveau mot de passe doit être différent de l\'ancien mot de passe',
            'new_password.required' => 'Le champ du nouveau mot de passe est requis',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères',
            'new_password.regex' => 'Le nouveau mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial',
            'password_confirmation.required' => 'Le champ de confirmation du mot de passe est requis',
            'password_confirmation.same' => 'La confirmation du mot de passe ne correspond pas au nouveau mot de passe',
        ]);

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->route('password.change')->with('error', 'Mot de passe actuel incorrect');
        }
        $user->update(['password' => bcrypt($request->input('new_password'))]);
        return redirect()->route('password.change')->with('success', 'Vous avez changé votre mot de passe avec succès');
    }

}