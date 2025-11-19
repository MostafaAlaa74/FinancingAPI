<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string|min:8'
        ]);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['messege' => 'Invalid Emali Or Password'], 401);
        }
        $user = User::where('email', $request->email)->firstorfail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'messege' => 'Welcome Back To The Website',
            'User' => $user,
            'Token' => $token
        ], 201);
    }
}
