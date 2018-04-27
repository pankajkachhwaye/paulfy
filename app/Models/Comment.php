<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    public function  scopeDeleteComment($query,$user_id,$comment_id )
    {
        return $query->where(function($query) use  ($user_id,$comment_id) {

            $query->where('news_id', $comment_id)
                ->Where('user_id', $user_id);

        });

    }

    protected $fillable=[
        'user_id','news_id','comment'
    ];
}
