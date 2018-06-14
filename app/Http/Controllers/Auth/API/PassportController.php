<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use App\Http\Resources\Users as UsersResource;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Resources\Json\JsonResource;

class PassportController extends Controller
{

    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success, 'role' => $user->role], $this->successStatus);
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
       $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]
           ,
           [
       'email.unique' => 'email gia esistente'
    ]);

        if ($validator->fails() ) {
            return response()->json($validator->errors()->first(), 401);
        }
else {
    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] = $user->createToken('MyApp')->accessToken;
    $success['name'] = $user->name;

    return response()->json(['success' => $success], $this->successStatus);
}
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails()
    {
        $user = Auth::user();
        return $prova = $user;
        
    }

    public function  iSAdmin(){
        $user = Auth::user();
        return $prova = $user['role'];
    }
}