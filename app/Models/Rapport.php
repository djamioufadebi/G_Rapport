<?php

namespace App\Models;

use App\Models\Projet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    // un rapport appartient appartient à un projet
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }
    // un rapport est fait par un seul utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
