<?php

namespace App\Models;

use App\Models\Besoin;
use App\Models\Bilan;
use App\Models\Intervenant;
use App\Models\Projet;
use App\Models\Rapport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    // une activité appartient a un projet
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }
    // une activité peut avoir plusieurs intervenants
    public function intervenant()
    {
        return $this->belongsToMany(Intervenant::class, 'id_activite');
    }

    // Une activité peut avoir plusieurs rapports
    public function rapport()
    {
        return $this->belongsToMany(Rapport::class, 'id_activite');
    }

    public function besoin()
    {
        return $this->belongsToMany(Besoin::class, 'id_activite');
    }

}
