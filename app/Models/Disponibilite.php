<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disponibilite extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'disponibilites';

    protected $fillable = [
        'date_debut', 
        'date_fin',
        'heure',    
        'destination',
        'statut',
        'id_chauffeur',
    ];
    public function chauffeur()
    {
        return $this->belongsTo(User::class, 'id_chauffeur');
    }
}
