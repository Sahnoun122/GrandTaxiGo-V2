<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Disponibilite;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trajet extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = ['date', 'lieu', 'destination', 'id_passager', 'id_dispo', 'statut'];

    public function passager()
    {
        return $this->belongsTo(User::class, 'id_passager');
    }

    public function disponibilite()
    {
        return $this->belongsTo(Disponibilite::class, 'id_dispo');
    }
}
