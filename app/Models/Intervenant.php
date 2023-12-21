<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervenant extends Model
{
    use HasFactory;

    // un intervenant peut intervenir à plusieurs projets
    public function projet()
    {
        return $this->belongsToMany(Projet::class);
    }

}