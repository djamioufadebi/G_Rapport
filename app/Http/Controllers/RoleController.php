<?php

namespace App\Http\Controllers;

use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        if (Gate::allows('viewliste', Role::class)) {
            return view('Roles.liste');
        } else {

            return view('composants.acces_refuser');
        }
    }


    public function create()
    {
        return view('roles.create');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }
}