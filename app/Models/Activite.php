<?php

namespace App\Models;

use App\Models\Bilan;
use App\Models\Intervenant;
use App\Models\Projet;
use App\Models\Rapport;
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
    // un projet a plusieurs activites
    public function intervenant()
    {
        return $this->belongsTo(Intervenant::class);
    }

    // Une activité peut avoir plusieurs rapports
    public function rapport()
    {
        return $this->belongsToMany(Rapport::class, 'id_activite');
    }

    // relation entre activité et bilan : pour une activité on peut faire plusieurs bilans
    //public function bilan()
    // {
    //     return $this->hasMany(Bilan::class, 'activite_id');
    //  }

}