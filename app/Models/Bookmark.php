<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use\App\Models\Rssfeed;

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

    public function scopeDeleteBookmark($query,$user_id,$id)
    {
        return $query->where(function($query) use ($user_id,$id){

            $query->where('user_id',$user_id)
            ->where('id',$id);
        });

    }

    public function news()
    {
        return $this->belongsTo(Rssfeed::class,'news_id');
    }
}
