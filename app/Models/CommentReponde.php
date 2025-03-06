<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentReponde extends Model
{
    protected $fillable = [
        'comment_id', 'chauffeur_id', 'reponde'
    ];

    public function comment()
    {
        return $this->belongsTo(comments::class);
    }

    public function chauffeur()
    {
        return $this->belongsTo(User::class);
    }
}