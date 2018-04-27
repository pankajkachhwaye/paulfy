<?php

namespace App\Models;
use App\Models\Rssfeed;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    //

//    protected $fillable=[
//        'user_id','news_id','like'
//    ];

            public function news()
            {
                belongsTo(Rssfeed::class,'news_id');

            }

            public function scopeCheckLike($query,$news_id,$user_id)
            {
                return $query->where(function($query) use ($news_id,$user_id) {
                    $query->where('news_id', $news_id)
                        ->Where('user_id', $user_id);
                });

            }
}
