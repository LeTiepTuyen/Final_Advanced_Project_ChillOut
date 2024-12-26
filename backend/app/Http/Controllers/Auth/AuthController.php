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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if (!$user) {
            return response()->json(['message' => 'User registration failed.'], 500);
        }

        // Tạo token với UUID
        $token = $user->createToken('Auth Token')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful.',
            'token_type' => 'Bearer',
            'token' => $token,
            'user_id' => $user->id, // Để đảm bảo UUID của user được trả về
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        // Tạo token với UUID
        $token = $user->createToken('Auth Token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token_type' => 'Bearer',
            'token' => $token,
            'user_id' => $user->id, // Để đảm bảo UUID của user được trả về
        ], 200);
    }

    public function profile(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'Profile fetched successfully.',
            'data' => $request->user(),
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful.',
        ], 200);
    }
}
