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
}
