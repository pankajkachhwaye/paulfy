<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\AppUser;
use App\Models\Rssfeed;
use Illuminate\Http\Request;

class ApiPanelController extends Controller
{


    public function index(){
        return view('api.apidetails');
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
         $categories= Categories::all();
         return view('api.user.getnewsByCategoriesId',compact('categories'));

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
    public function bookmarkNews()
    {
        $news= Rssfeed::all();
        $users= AppUser::all();
        return view('api.user.bookmarkNews',compact('news','users'));
    }
    public function deleteComment()
    {
        return view('api.user.deleteComment');
    }
    public function deleteBookmark()
    {
        return view('api.user.deleteBookmark');

    }


}
