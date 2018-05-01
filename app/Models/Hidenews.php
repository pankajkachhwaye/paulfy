<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hidenews extends Model
{
    //

    public function scopeCheckHide($query,$news_id,$user_id)
    {
        return $query->where(function($query) use ($news_id,$user_id) {
            $query->where('news_id', $news_id)
                ->Where('user_id', $user_id);
        });

    }

    public function scopeHide($query,$user_id,$id)
    {
        return $query->where(function($query) use ($user_id,$id){

            $query->where('user_id',$user_id)
                ->where('news_id',$id);
        });

    }

    public function news()
    {
        return $this->belongsTo(Rssfeed::class,'news_id');
    }
}
