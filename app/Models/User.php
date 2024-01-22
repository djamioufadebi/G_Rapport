<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Bilan;
use App\Models\Profil;
use App\Models\Rapport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    // un user peut faire plusieurs rapports
    public function rapport()
    {
        return $this->belongsToMany(Rapport::class);
    }

    // un user a un profil
    public function profil()
    {
        return $this->belongsTo(Profil::class, 'id_profil');
    }

    // un user peut être responsable de plusieurs projets
    public function projet()
    {
        return $this->belongsToMany(Projet::class, 'id_projet');
    }

    // un user peut faire plusieurs bilans
    public function bilan()
    {
        return $this->hasMany(Bilan::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'contact',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
