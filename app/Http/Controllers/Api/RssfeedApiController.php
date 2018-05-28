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
use App\Models\Hidenews;
use App\Models\AppUser;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RssfeedApiController extends Controller
{
    //

    public function getnewsByCategoriesId(Request $request)
    {

//        $rssfeed= Rssfeed::whereIn('categories_id',$request->categories_id)->with('likes')->with('hide')->with('comment')
//            ->with('bookmark')
//        ->orderBy('created_at','desc')
//        ->get()->sortByDesc(function($rssfeed)
//            {
//                return $rssfeed->likes->count() + $rssfeed->comment->count();
//            });
        $rssfeed= Rssfeed::whereIn('categories_id',$request->categories_id)->with('likes')->with('hide')->with('comment')->with('bookmark')
            ->withCount('likes')->withCount('comment')->orderBy('created_at','desc')->orderBy('likes_count', 'desc')->orderBy('comment_count', 'desc')
            ->get();
//            dd($rssfeed);
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

                      // chek is news save or not
                    $rssfeed[$k]->isSave= false;

                    foreach ($rssfeed[$k]->bookmark as $value)
                    {
                        if($value->user_id== $request->user_id)
                        {
                            $rssfeed[$k]->isSave= true;
                            break;
                        }
                    }


                    //check hide or show
                    $rssfeed[$k]->isHide= false;

                    foreach ($rssfeed[$k]->hide as $value)
                    {
                        if($value->user_id== $request->user_id)
                        {
                            $rssfeed[$k]->isHide= true;
                            break;
                        }
                    }



        /// add extra perametor
                    $rssfeed[$k]->description = str_replace('"', "'", $v->description);
                    $rssfeed[$k]->likeCount= count($rssfeed[$k]->likes);
                    $rssfeed[$k]->commentCount= count($rssfeed[$k]->comment);
                    $rssfeed[$k]->hideCount= count($rssfeed[$k]->hide);
                    $rssfeed[$k]->bookmarkCount= count($rssfeed[$k]->bookmark);



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

    public function getnewsLikesComment(Request $request)
    {

        $rssfeed= Rssfeed::whereIn('categories_id',$request->categories_id)->with('likes')->with('hide')->with('comment')
            ->with('bookmark')
        ->orderBy('created_at','desc')
        ->get()->sortByDesc(function($rssfeed)
            {
                return $rssfeed->likes->count() + $rssfeed->comment->count();
            });

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

                      // chek is news save or not
                    $rssfeed[$k]->isSave= false;

                    foreach ($rssfeed[$k]->bookmark as $value)
                    {
                        if($value->user_id== $request->user_id)
                        {
                            $rssfeed[$k]->isSave= true;
                            break;
                        }
                    }


                    //check hide or show
                    $rssfeed[$k]->isHide= false;

                    foreach ($rssfeed[$k]->hide as $value)
                    {
                        if($value->user_id== $request->user_id)
                        {
                            $rssfeed[$k]->isHide= true;
                            break;
                        }
                    }



        /// add extra perametor
                    $rssfeed[$k]->description = str_replace('"', "'", $v->description);
                    $rssfeed[$k]->likeCount= count($rssfeed[$k]->likes);
                    $rssfeed[$k]->commentCount= count($rssfeed[$k]->comment);
                    $rssfeed[$k]->hideCount= count($rssfeed[$k]->hide);
                    $rssfeed[$k]->bookmarkCount= count($rssfeed[$k]->bookmark);



//                    $rssfeed[$k]->comment =  ;
                }

//                dd($rssfeed);
                return Response::json(['code' => 200, 'status' => true, 'message' => 'All News Data', 'data' =>
                    array_values($rssfeed->toArray())]);
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

        foreach($categories as $k=> $v)
        {
            //$categories[$k]->image= Storage::get($categories[$k]->image);
           // $categories[$k]->image= Storage::get('business.png');
            $categories[$k]->image= asset('storage/'.$categories[$k]->image);

        }

        return Response::json(['code' => 200,'status' => true, 'message' => 'All Categories','data'=>$categories]);
    }

     public function likeNews(Request $request)
     {
            $likes= array();
            $likes['news_id']=$request->news_id;
            $likes['user_id']=$request->user_id;
            $likes['like']=1;
            $likes['created_at']=Carbon::now();

//            $checklike= Likes::whereIn([['news_id', '=',$request->news_id] , ['user_id','=',$request->user_id]])
//                ->first();
         $checklike= Likes::CheckLike($request->news_id,$request->user_id)->first();

            if ($checklike)
            {

                $data= Likes::Dislike($request->user_id,$request->news_id)->delete();

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

     public function deleteBookmarks(Request $request)
     {
         //dd($request->toArray());

         $data= Bookmark::DeleteBookmark($request->user_id,$request->bookmark_id)->delete();

         if($data)
         {
             return Response::json(['code' => 200,'status' => true, 'message' => ' Delete successfully ',
                 'data'=>""]);

         }
         else
         {
             return Response::json(['code' => 400,'status' => false, 'message' => 'Something Wrong.. ',
                 'data'=>""]);
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

            $data= Bookmark::with('news')->where('user_id',$request->user_id)->get();
//            dd($data);
         if($data)
         {
                 return Response::json(['code' => 200, 'status' => true, 'message' => 'All News Data', 'data' =>
                     $data]);
         }
        else
        {
        return Response::json(['code' => 400, 'status' => false, 'message' => 'Something wrong...', 'data' =>
        ""]);

        }

     }
     public function getAllHideNews(Request $request)
     {

            $data= Hidenews::with('news')->where('user_id',$request->user_id)->get();


//            dd($data);
         if($data)
         {
                 return Response::json(['code' => 200, 'status' => true, 'message' => 'All News Data', 'data' =>
                     $data]);
         }
        else
        {
        return Response::json(['code' => 400, 'status' => false, 'message' => 'Something wrong...', 'data' =>
        ""]);

        }

     }

     public function hideunhideNews(Request $request)
     {

         $likes= array();
         $likes['news_id']=$request->news_id;
         $likes['user_id']=$request->user_id;
//         $likes['like']=1;
         $likes['created_at']=Carbon::now();

//            $checklike= Likes::whereIn([['news_id', '=',$request->news_id] , ['user_id','=',$request->user_id]])
//                ->first();
         $CheckHide= Hidenews::CheckHide($request->news_id,$request->user_id)->first();

         if ($CheckHide)
         {
             $data= Hidenews::Hide($request->user_id,$request->news_id)->delete();

             if($data)
             {
                 return Response::json(['code' => 200,'status' => true, 'message' => ' Unhide successfully ',
                     'data'=>""]);

             }
             else
             {
                 return Response::json(['code' => 400,'status' => false, 'message' => 'Something Wrong.. ',
                     'data'=>""]);
             }
         }
         else
         {

             $id = Hidenews::insertGetId($likes);
             if(!empty($id))
             {
                 return Response::json(['code' => 200,'status' => true, 'message' => 'Hide successfully' ,
                     'data'=>$likes]);
             }
             else
             {
                 return Response::json(['code' => 400,'status' => false, 'message' => 'Something Wrong.. ',
                     'data'=>""]);

             }

         }


     }

     public function forgetPassword(Request $request)
     {

         $password['user_id']=$request->user_id;
         $password['new_password']= Hash::make($request->new_password) ;

         $CheckUser= AppUser::checkUser($request->user_id)->first();

         if(count($CheckUser))
         {


             AppUser::where('id', $request->user_id)
                                 ->update(['password' => $password['new_password']]);
             return Response::json(['code' => 200,'status' => true, 'message' => ' data found ',
                 'password'=>$request->new_password]);


         }
         else
         {
             return Response::json(['code' => 400,'status' => false, 'message' => ' user not found'
                ]);
         }









     }





}
