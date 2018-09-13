<?php

namespace App\Http\Controllers\API;

use Auth;
use App\User;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
    * login api
    *
    * @return \Illuminate\Http\Response
    */
    public function login(){
        if(Auth::attempt(['name' => request('name'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], 200);
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => ArticleResource::collection($user->articles)], 200); 
    } 
}
