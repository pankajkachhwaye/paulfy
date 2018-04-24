<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class ApiPanelController extends Controller
{


    public function index(){
        return view('api.apidetails');
    }

    public function registerForm(){
        return view('api.user.registeruser');
    }

    public function loginForm(){
        return view('api.user.loginuser');
    }

    public function getnewsByCategoriesId()
    {
            $categories= Categories::all();
         return view('api.user.getnewsByCategoriesId',compact('categories'));

    }

}
