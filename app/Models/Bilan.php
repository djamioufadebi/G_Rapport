<?php

namespace App\Models;

use App\Models\Activite;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bilan extends Model
{
    use HasFactory;

    // un bilan appartient à une activité et un projet à un client
    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
    // un bilan appartient à une activité et une activité à un projet
    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    // un bilan appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
