<?php

namespace App\Http\Controllers\Api;

use App\Models\AppUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $validate  = $this->validateUser($request);
        if(count($validate) > 0){
            return Response::json(['code' => 400,'status' => false, 'message' => 'Validation Error','data'=>$validate]);
        }
        else{
            $check = AppUser::GetByNameOrEmail($request->email,$request->user_name)->first();
            if($check != null){
                return Response::json(['code' => 400,'status' => false, 'message' => 'Validation Error','data'=>['User Already Exist']]);
            }
            else{
                $insert = [
                    'user_name' => $request->user_name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'device_type' => $request->device_type,
                    'device_token' => $request->device_token,
                    'created_at' => Carbon::now(),
                ];

                $id = AppUser::insertGetId($insert);
                $user = AppUser::find($id);
                return Response::json(['code' => 200,'status' => true, 'message' => 'User register successfully','data'=>$user]);
            }

        }
    }

    public function login(Request $request){
        $user = AppUser::GetByValue($request->value)->first();

        if($user == null){
            return Response::json(['code' => 400,'status' => false, 'message' => 'Error','data'=>['User not register']]);
        }
        else{
            if(Hash::check($request->password, $user->password)){
                $user->device_token = $request->device_token;
                    $user->save();
                return Response::json(['code' => 200,'status' => true, 'message' => 'User login successfully','data'=>$user]);
            }
            else{
                return Response::json(['code' => 400,'status' => false, 'message' => 'Error','data'=>['Invalid user name or password']]);
            }
        }
    }

    public function validateUser($data){
        $returnArray = [];
        if($data->user_name == null){
            array_push($returnArray,'Please enter Username');
        }

        if($data->email == null){
            array_push($returnArray,'Please enter Email');
        }

        if($data->password == null){
            array_push($returnArray,'Please enter password');
        }

        return $returnArray;
    }
}
