<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
    
        return response()->json(['message' => 'Registration successful']);
        }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email' , $credentials['email'])->first();
        if(!$user || !Hash::check($credentials['password'] , $user->password))
        {return response()->json(['message' => 'error in email or password'] , 401);}

            $token = $user->createToken($user->name.'authToken')->plainTextToken;
            return response()->json(['token' => $token] , 200);
        }
        public function logout(Request $request)
        {
            if (auth()->check()) {
                auth()->user()->tokens()->delete();
                return response()->json(['message' => 'Logout successful']);
            }
            return response()->json(['message' => 'No user authenticated'], 401);
        }
}
