<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
    }


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:20',
            'username' => 'required|alpha_dash|min:3|max:20|unique:users',
            'email' => 'required|string|email|max:35|unique:users',
            'num_phone' => 'required|string|min:9|max:9',
            'password' => 'required|string|min:8|confirmed:password_confirmation',
            'password_confirmation' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'num_phone' => $request->num_phone,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request['login'])->orWhere('username', $request['login'])->first();

        if(!$user || !Hash::check($request['password'], $user->password)) {

            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $user->update([
            'last_login_at' => Carbon::now(),
        ]);

        return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
        ], 200);
    }

    public function logout()
    {
        Auth::logout();
    }
}
