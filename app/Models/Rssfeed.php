<?php

namespace App\Models;
use App\Models\Likes;
use App\Models\Comment;


use Illuminate\Database\Eloquent\Model;

class Rssfeed extends Model
{

    public function likes()
    {
        return $this->hasMany(Likes::class,'news_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class,'news_id');
    }
}
