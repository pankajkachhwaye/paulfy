<?php

namespace App\Http\Controllers;

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

}
