<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    //register 
    public function register(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        //response
        return response()->json([
            "status" => true,
            "message" => "user registerd successfully"
        ]);
    }
    //login 
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        //atempt
        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password,
        ]);
        if (!empty($token)) {
            return response()->json([
                "status" => true,
                "message" => "user logged in successfully",
                'token' => $token,
            ]);
        }
        return response()->json([
            "status" => false,
            "message" => "login problem",
            
        ]);
    }
    //profile 
    public function profile() {
          $userData = auth()->user();

          return response()->json([
            "status" => true,
            "message" => "users Profile",
            "userData" => $userData,
          ]);

    }
    //token 
    public function refreshtoken() {

        $newToken = auth()->refresh();
        return response()->json([
            "status" => true,
            "message" => "new token generated",
            "newToken" => $newToken,
          ]);
    }
    //refreshtoken 
    public function logout() {

        auth()->logout();
        return response()->json([
            "status" => true,
            "message" => "logout successfully",
            
          ]);
    }
}
