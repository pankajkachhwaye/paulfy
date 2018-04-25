<?php

namespace App\Http\Controllers\Api;
//use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rssfeed;
use App\Models\Categories;
use Response;

class RssfeedApiController extends Controller
{
    //

    public function getnewsByCategoriesId(Request $request)
    {

        $rssfeed= Rssfeed::whereIn('categories_id',$request->categories_id)->get();

            foreach ($rssfeed as $k=>$v )
            {
                $rssfeed[$k]->description= str_replace('"',"'", $v->description);

            }


//        dd($rssfeed->toArray());
        return Response::json(['code' => 200,'status' => true, 'message' => 'User login successfully','data'=>$rssfeed]);

    }

    public  function getAllCategories()
    {
        $categories= Categories::all();
        return Response::json(['code' => 200,'status' => true, 'message' => 'All Categories','data'=>$categories]);
    }

     public function likeNews(Request $request)
     {
         //toggle like dislike
         dd($request->toArray());
     }
     public function commentNews(Request $request)
     {
                dd($request->toArray());

            //commentonnews
     }
     public function bookmarkNews(Request $request)
     {
            //savebookmarks
           dd($request->toArray());
     }
}
