<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return false;
        }
        $request->session()->regenerate();

        // Store user_id in the session
        $request->session()->put('user_id', $user->id);
        return $user->id;
    return session()->get('user_id');
        // Destroy other sessions for the same user
        $currentSessionId = Session::getId();
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $currentSessionId)
            ->delete();
            
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Logged in successfully',
            'token' => $token,
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
