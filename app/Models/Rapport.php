<?php

namespace App\Models;

use App\Models\activite;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    // un rapport appartient appartient à un activite
    public function activite()
    {
        return $this->belongsTo(Activite::class, 'id_activite');
    }
    // un rapport est fait par un seul utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
