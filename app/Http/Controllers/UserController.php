<?php

namespace App\Http\Controllers;

use App\Models\User;

use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Gate;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class UserController extends Controller
{

    use WithPagination;
    public function index()
    {
        if (Gate::allows('viewliste', User::class)) {
            return view('utilisateurs.liste');
        } else {
            return view('composants.acces_refuser');
        }
    }

    public function create()
    {
        return view('utilisateurs.create');
    }

    public function edit(User $user)
    {
        return view('utilisateurs.edit', compact('user'));
    }

    public function show(User $user)
    {
        return view('utilisateurs.show', compact('user'));
    }

    public function generatepdf()
    {
        $user = Auth::user();
        if ($user->id_profil == 1 || $user->id_profil == 2 || $user->id_profil == 3) {
            $users = User::all();
            $pdf = Pdf::loadView('PDF.user_pdf', ['users' => $users]);
            // return $pdf->download('liste_des_utilisateurs.pdf');
            return $pdf->stream();
        } else {
            return view('composants.acces_refuser');
        }
    }

}