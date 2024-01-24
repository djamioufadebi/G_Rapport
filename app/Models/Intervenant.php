<?php

namespace App\Models;

use App\Models\Activite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervenant extends Model
{
    use HasFactory;

    // un intervenant peut intervenir à plusieurs activités
    public function activite()
    {
        return $this->belongsTo(Activite::class, 'id_activite');
    }

}