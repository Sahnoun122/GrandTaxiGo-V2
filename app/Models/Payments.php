<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'user_id', 
        'stripe_payment_id', 
        'amount', 
        'currency', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getStatusAttribute($value)
    {
        $statuses = [
            'reussi' => 'Succès',
            'echec' => 'Échec',
            'en_attente' => 'En attente'
        ];

        return $statuses[$value] ?? $value;
    }
}
