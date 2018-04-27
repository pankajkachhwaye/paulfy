<?php

namespace App\Http\Controllers\Api;
//use http\Env\Response;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rssfeed;
use App\Models\Categories;
use App\Models\Likes;
use App\Models\Comment;
use Response;
use Carbon\Carbon;

class RssfeedApiController extends Controller
{
    //

    public function getnewsByCategoriesId(Request $request)
    {

        $rssfeed= Rssfeed::whereIn('categories_id',$request->categories_id)->with('likes')->with('comment')->get();

            if($rssfeed) {
                foreach ($rssfeed as $k => $v) {

                    $rssfeed[$k]->isLike= false;

                      foreach ($rssfeed[$k]->likes as $value)
                      {
                          if($value->user_id== $request->user_id)
                          {
                              $rssfeed[$k]->isLike= true;
                              break;
                          }
                      }

                    $rssfeed[$k]->description = str_replace('"', "'", $v->description);
                    $rssfeed[$k]->likeCount= count($rssfeed[$k]->likes);
                    $rssfeed[$k]->commentCount= count($rssfeed[$k]->comment);

//                    $rssfeed[$k]->comment =  ;
                }


                return Response::json(['code' => 200, 'status' => true, 'message' => 'All News Data', 'data' =>
                    $rssfeed]);
            }
            else
            {
                return Response::json(['code' => 400, 'status' => false, 'message' => 'Something wrong...', 'data' =>
                    ""]);

            }
    }

    public  function getAllCategories()
    {
        $categories= Categories::all();
        return Response::json(['code' => 200,'status' => true, 'message' => 'All Categories','data'=>$categories]);
    }

     public function likeNews(Request $request)
     {
            $likes= array();
            $likes['news_id']=$request->news_id;
            $likes['user_id']=$request->user_id;
            $likes['like']=$request->like;
            $likes['created_at']=Carbon::now();

//            $checklike= Likes::whereIn([['news_id', '=',$request->news_id] , ['user_id','=',$request->user_id]])
//                ->first();
         $checklike= Likes::CheckLike($request->news_id,$request->user_id)->first();

            if ($checklike)
            {
                return Response::json(['code' => 400,'status' => false, 'message' => 'You already like this news' ,
                    'data'=>'']);
            }
            else
            {


                $id = Likes::insertGetId($likes);
                if(!empty($id))
                {
                    return Response::json(['code' => 200,'status' => true, 'message' => 'Like successfully' ,
                        'data'=>$likes]);
                }
                else
                {
                    return Response::json(['code' => 400,'status' => false, 'message' => 'Something Wrong.. ',
                        'data'=>""]);

                }

            }

     }
     public function commentNews(Request $request)
     {

                $comment= new Comment;
                $comment->news_id=$request->news_id;
                $comment->user_id=$request->user_id;
                $comment->comment=$request->comment;
              //  $comment->save();

         if( $comment->save())
         {
             return Response::json(['code' => 200,'status' => true, 'message' => 'Comment Successfully' ,
                 'data'=>$comment]);
         }
         else
         {
             return Response::json(['code' => 400,'status' => false, 'message' => 'Something Wrong.. ',
                 'data'=>""]);

         }

     }

     public function deleteCommentNews()
     {

     }
     public function bookmarkNews(Request $request)
     {
         $bookmark = new Bookmark;
         $bookmark->user_id=$request->user_id;
         $bookmark->news_id=$request->news_id;

         $checkbookmark= Bookmark::CheckBookmark($request->news_id,$request->user_id)->first();

         if($checkbookmark)
         {

             return Response::json(['code' => 400,'status' => false, 'message' => 'News Already Save' ,
                 'data'=>$bookmark]);
         }
         else
         {
             if($bookmark->save())
             {
                 return Response::json(['code' => 200,'status' => true, 'message' => 'News Save Successfully' ,
                     'data'=>$bookmark]);
             }
             else
             {
                 return Response::json(['code' => 400,'status' => false, 'message' => 'Something Wrong.. ',
                     'data'=>""]);

             }

         }

     }



     public function dislikeNews(Request $request)
     {
         $data= Likes::Dislike($request->user_id,$request->id)->delete();

         if($data)
         {
             return Response::json(['code' => 200,'status' => true, 'message' => ' Dislike successfully ',
                 'data'=>""]);

         }
         else
         {
             return Response::json(['code' => 400,'status' => false, 'message' => 'Something Wrong.. ',
                 'data'=>""]);
         }
     }

     public function getAllBokkmarkNews(Request $request)
     {

     }

}
