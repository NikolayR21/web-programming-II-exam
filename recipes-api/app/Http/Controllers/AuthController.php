<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|max:255|string|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'firstName' => $fields['firstName'],
            'lastName' => $fields['lastName'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Wrong information!'
            ], 401);
        };

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];

        return response($response, 201);
    }

    public function profile(Request $request){
        return $request->user();
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
