<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignerProfilController extends Controller
{
    public function index()
    {
        return view('modals.profils.assigne');
    }

    public function create()
    {
        return view('modals.profils.edit');
    }



}