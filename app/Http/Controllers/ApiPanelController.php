<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\AppUser;
use App\Models\Rssfeed;
use Illuminate\Http\Request;
use Response;

class ApiPanelController extends Controller
{


    public function index(){
        return view('api.apidetails');
    }

    public function getCommetNews($id){
      $news= Rssfeed::find($id);
      $comment = $news->comment()->get();
      return Response::json($comment);
    }

    public function registerForm(){
        return view('api.user.registeruser');
    }
    public function getAllCategories(){
        return view('api.user.getAllCategories');
    }


    public function loginForm(){
        return view('api.user.loginuser');
    }

    public function getnewsByCategoriesId()
    {
        $users= AppUser::all();
         $categories= Categories::all();
         return view('api.user.getnewsByCategoriesId',compact('categories','users'));

    }

    public function getnewsLikesComment()
    {
        $users= AppUser::all();
         $categories= Categories::all();
         return view('api.user.getnewsLikesComment',compact('categories','users'));

    }

    public function likeNews()
    {
        $news= Rssfeed::all();
        $users= AppUser::all();
        return view('api.user.likenews',compact('news', 'users'));

    }
    public function commentOnNews()
    {
        $news= Rssfeed::all();
        $users= AppUser::all();
        return view('api.user.commentOnNews',compact('news','users'));
    }

    public function replyOnCommentForm()
    {
        $news= Rssfeed::all()->take(200);
        $users= AppUser::all();
        return view('api.user.replycomment',compact('news','users'));
    }
    public function upvoteOnCommentForm()
    {
        $news= Rssfeed::all();
        $users= AppUser::all();
        return view('api.user.upvotecommnet',compact('news','users'));
    }
    public function bookmarkNews()
    {
        $news= Rssfeed::all();
        $users= AppUser::all();
        return view('api.user.bookmarkNews',compact('news','users'));
    }
    public function getAllBokkmarkNews()
    {
//        $news= Rssfeed::all();
        $users= AppUser::all();
        return view('api.user.getAllSaveNews',compact('users'));
    }

    public function deleteComment()
    {
        return view('api.user.deleteComment');
    }
    public function deleteBookmark()
    {
        $users= AppUser::all();
        return view('api.user.deleteBookmark',compact('users'));

    }


}
