<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ])->validate();

        $user  = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('GUEST');

        $token = $user->createToken($user->name);

        return response([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'token' => $token->accessToken,
            'token_expires_at' => $token->token->expires_at,
        ], 200);

    }

    public function login(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ])->validate();

        $user  = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'noti' => 'Invalid login credential!!'
            ], 401);
        }

        $token = $user->createToken($user->name);

        return response([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'token' => $token->accessToken,
            'token_expires_at' => $token->token->expires_at,
            //'token' => $tokenssToken,
            //'token_expires_at' => $token->token->expires_at->acce,
        ], 200);
    }

    public function logout(Request $request)
    {
        Validator::make($request->all(), [
            'allDevice' => 'required|boolean',
        ])->validate();

        $user = Auth::user();
        if ($request->allDevice) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });
            return response(['message' => 'Logged out from all device !!'], 200);
        }

        $userToken = $user->token();
        $userToken->delete();

        return response(['message' => 'Logged Successful !!'], 200);

    }
}
