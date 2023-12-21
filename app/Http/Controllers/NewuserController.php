<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewuserController extends Controller
{
    public function confirm()
    {
        return view('composants.redirection-new-user');
    }
}
