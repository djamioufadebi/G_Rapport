<?php

namespace App\Http\Controllers;

use App\Models\User;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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

        $dateToday = Carbon::now();
        $user = Auth::user();
        if ($user->id_profil == 1) {
            $users = User::all();
            $pdf = Pdf::loadView('PDF.user_pdf', compact('users', 'dateToday'));
            return $pdf->stream();
        }
    }

}