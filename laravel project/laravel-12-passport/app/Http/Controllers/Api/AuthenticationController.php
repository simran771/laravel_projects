<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
        public function register(Request $request)
        {
             
            try{
                $user = User::create($request->all());
                return response()->json([ 
                    'user' => $user, 
                    'token' => $user->createToken('passportToken')->accessToken
                ], 200);
            }catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong',
                    'error' => $e->getMessage()
                ], 500); 
        }
    }
      
        public function login(Request $request)
        {

            // dd("testing...");api
            $credentials = [
                'email'    => $request->email,
                'password' => $request->password
            ];
      
            if (Auth::attempt($credentials)) 
            {
                $token = Auth::user()->createToken('passportToken')->accessToken;
                 
                return response()->json([
                    'user' => Auth::user(), 
                    'token' => $token
                ], 200);
            }
      
            return response()->json([
                'error' => 'Unauthorised'
            ], 401);
      
        }
    }
    
