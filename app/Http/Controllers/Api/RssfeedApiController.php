<?php

namespace App\Http\Controllers\Api;
//use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rssfeed;
use Response;

class RssfeedApiController extends Controller
{
    //

    public function getnewsByCategoriesId(Request $request)
    {

        $rssfeed= Rssfeed::where('categories_id',$request->categories_id)->get();

//        dd($rssfeed);
        return Response::json(['code' => 200,'status' => true, 'message' => 'User login successfully','data'=>$rssfeed]);

    }

     public function likeNews()
     {
         //toggle like dislike
     }
     public function commentNews()
     {

            //commentonnews
     }
     public function bookmarkNews()
     {
            //savebookmarks



     }
}
