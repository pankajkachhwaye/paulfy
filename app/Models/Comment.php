<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    public function reply(){
        return $this->hasMany('App\Models\Reply','comment_id');
    }

    public function upvoteComment(){
        return $this->hasMany('App\Models\UpvoteComment','comment_id');
    }

    public function  scopeDeleteComment($query,$user_id,$comment_id )
    {
        return $query->where(function($query) use  ($user_id,$comment_id) {

            $query->where('news_id', $comment_id)
                ->Where('user_id', $user_id);

        });

    }

      public function user()
    {
        return $this->belongsTo(AppUser::class,'user_id');
    }


    protected $fillable=[
        'user_id','news_id','comment'
    ];
}
