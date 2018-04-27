<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    //
    protected $fillable=[
        'user_id','news_id','bookmark'
    ];


    public function scopeCheckBookmark($query,$news_id,$user_id)
    {
        return $query->where(function($query) use ($user_id,$news_id){

                $query->where('news_id',$news_id)
                    ->where('user_id',$user_id);
        });
    }
}
