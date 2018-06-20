<?php

namespace App\Models;
use App\Models\Likes;
use App\Models\Comment;
use App\Models\Bookmark;
use App\Models\Hidenews;


use Illuminate\Database\Eloquent\Model;

class Rssfeed extends Model
{

    public function likes()
    {
        return $this->hasMany(Likes::class,'news_id');
    }

    public function comment()
    {
        // return $this->hasMany(Comment::class,'news_id');
         return $this->hasMany(Comment::class,'news_id')->with('user');
    }

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class,'news_id');
    }

    public function hide()
    {
        return $this->hasMany(Hidenews::class,'news_id');
    }

}
