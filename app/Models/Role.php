<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // un role peut etre attributer à plusieurs profils
    public function profil()
    {
        return $this->belongsToMany(Profil::class);
    }

}