<?php

namespace App\Models;

use App\Models\Projet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Besoin extends Model
{
    use HasFactory;

    // un besoin appartient à un projet
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }
}
