<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    public function user()
    {
        return $this->belongsTo(AppUser::class,'user_id');
    }

    protected $fillable=[
        'user_id','news_id','comment_id','reply'
    ];
    protected $table = 'reply';
}
