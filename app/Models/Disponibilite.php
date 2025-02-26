<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    use HasFactory;
    protected $table ='disponibilites';
    protected $fillable = [
        'dateDebut',
        'dateFin',
        'destination',
        'statut',
        'id_chauffeur',
        
    ];
}
