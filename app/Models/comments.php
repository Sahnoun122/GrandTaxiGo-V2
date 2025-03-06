<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Disponibilite;
use App\Models\User;
use App\Models\CommentReponde;

class comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'disponibilite_id', 'user_id', 'comment', 'rating'
    ];

    public function disponibilite()
    {
        return $this->belongsTo(Disponibilite::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(CommentReponde::class);
    }
}
