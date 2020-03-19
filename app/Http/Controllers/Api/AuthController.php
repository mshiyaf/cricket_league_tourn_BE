<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 

class AuthController extends Controller 
{
    public $successStatus = 200;
  
    public function register(Request $request) {    
        $registerData = $request->validate([ 
                        'name' => 'required|max:55',
                        'email' => 'required|email|unique:users',
                        'password' => 'required|confirmed'
                    ]);   
        
        $registerData['password'] = bcrypt($registerData['password']);

        $user = User::create($registerData); 
        $success['token'] =  $user->createToken('APIToken')->accessToken;
        return response()->json([   
                                    'email' => $user['email'],   
                                    'access_token' => $success['token'],
                                    'token_type' => 'bearer'
                                ], $this-> successStatus); 
    }
  
   
    public function login(Request $request){ 

        $loginData =  $request->validate([
                        'email' => 'required|email',
                        'password' => 'required'
                    ]);   

        if (!auth()->attempt($loginData)){
                return response()->json(['message'=>'Invalid Credentials'],401);
        }
       
        $user = Auth::user(); 
        $success['token'] =  $user->createToken('APIToken')-> accessToken; 
        return response()->json([   
                                    'email' => $user['email'],   
                                    'access_token' => $success['token'],
                                    'token_type' => 'bearer'
                                ], $this-> successStatus); 
 
    }
  
    public function getUsers() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus); 
    }
} 