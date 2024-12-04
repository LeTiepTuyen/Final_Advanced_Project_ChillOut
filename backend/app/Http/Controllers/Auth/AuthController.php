<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{


    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            $token = $user->createToken($user->name . 'Auth-token')->plainTextToken;

            return response()->json([
                'message' => 'Register successful',
                'token_type' => 'Bearer',
                'token' => $token,
            ], 201);
        }else{
            return response()->json([
                'message' => 'Register failed',
            ], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken($user->name . 'Auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token_type' => 'Bearer',
            'token' => $token,
        ], 200);
    }

    public function profile(Request $request)
    {
        if($request->user()){
            return response()->json([
                'message' => 'Profile fetched',
                'data' => $request->user()
            ],200);
        }else{
            return response()->json([
                'message'=>'Not authenticated'
            ],401);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $user = User::where('id', $request->user()->id)->first();
        if($user){
            $user ->tokens()->delete();

            return response()->json([
                'message' => 'Logout successful',
            ], 200);
        }else{
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }
    }
}
