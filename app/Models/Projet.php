<?php

namespace App\Models;

use App\Models\Activite;
use App\Models\Besoin;
use App\Models\Bilan;
use App\Models\Client;
use App\Models\Rapport;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // un projet a plusieurs intervenants
    public function intervenant()
    {
        return $this->belongsToMany(Intervenant::class, 'id_projet');
    }

    // rélation entre projet et bilan : Pour un projet on peut faire plusieurs bilans
    public function bilan()
    {
        return $this->belongsToMany(Bilan::class, 'projet_id');
    }

    // un projet a un seul chef chantier
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


    //public function user()
    //{
    //  return $this->belongsTo(User::class)->where('id_user', $this->id_user)->where('id_gestionnaire', $this->id_gestionnaire);
    //}


    // un projet a plusieurs rapports

    // un projet a plusieurs besoins
    public function besoin()
    {
        return $this->belongsToMany(Besoin::class, 'id_projet');
    }

    public function rapport()
    {
        return $this->belongsToMany(Rapport::class, 'id_projet');
    }

    // un projet a plusieurs activités
    public function activite()
    {
        return $this->belongsToMany(Activite::class, 'id_projet');
    }


    // un projet appartient à un seul client
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }
}
