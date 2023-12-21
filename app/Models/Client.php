<?php

namespace App\Models;

use App\Models\Projet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // un client peut avoir plusieurs projets
    public function projet()
    {
        return $this->hasMany(Projet::class);
    }
}