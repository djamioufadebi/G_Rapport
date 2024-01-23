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

    public function updateProfile(Request $request)
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Valider les données du formulaire
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Les règles de validation pour le fichier photo
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            // Les règles de validation pour l'email (unique)
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Mettre à jour les informations du profil
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');

        // Gérer la mise à jour de la photo si elle est fournie
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('profil_photos', 'public'); // spécifie le répertoire 'storage/app/public/profil_photos' créé
            $user->photo = $photoPath;
        }
        // Enregistrer les modifications
        $user->save();

        return redirect()->route('mon-profile')->with('status', 'Profil mis à jour avec succès');
    }

}