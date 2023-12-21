<?php

namespace App\Models;

use App\Models\Projet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    // un projet a plusieurs activites
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }
}