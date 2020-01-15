<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserApi extends Controller
{
    public function signup(Request $request){
        $validator= $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'confirm_password'=>'required|same:password'

        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $input=$request->all();
        $input['password']=bcrypt($input['errors']);
        $saved= User::create($validator);

        if($saved){
        $success['token'] =  $saved->createToken('token')->accessToken;
        $success['message'] = "Registration successfull..";
        return UserResource::collection($saved->all());
        }
        else{
            App::abort(401, 'Sorry! Registration is not succesfull')
        }
    }
}
