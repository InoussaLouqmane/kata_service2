<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "The provided credentials are incorrect"
            ], 401);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => "logged successfully"
        ], 200);

    }

    public function logout(Request $request){
        $user = $request->input(User::ID);
        $request->user()->tokens()->delete();
    }
}
