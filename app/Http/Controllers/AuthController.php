<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\DeviceToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model\Token;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        
        Validator::make($request->all(), [
            'identificacion' => 'required',
            'name' => 'required|string|max:255',
            'telefono' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ])->validate();

        $user  = User::create([
            'identificacion' => $request->identificacion,
            'name' => $request->name,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estado' => 'Activo'
        ]);

        $user->assignRole('GUEST');

        $usuario = User::find($user->id);

        $token = $user->createToken($user->name);

        return response([
            'ok' => true,
            'user' => $usuario,
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
                'message' => 'Error',
                'errors' => 'Invalid login credential!!'
            ], 401);
        }

        $token = $user->createToken($user->name);

        return response([
            'ok' => true,
            'user' => $user,
            'token' => $token->accessToken,
            'token_expires_at' => $token->token->expires_at,
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

    public function checkToken(Request $request){
        
        $user = Auth::guard('api')->user();

        $user->tokens->each(function ($token) {
            $token->delete();
        });

        $usuario = User::find($user->id);

        $token = $user->createToken($usuario->name);
        return response([
            'ok' => true,
            'user' => $usuario,
            'token' => $token->accessToken,
            'token_expires_at' => $token->token->expires_at,
        ], 200);
    }

    public function saveToken(Request $request)
    {
        Validator::make($request->all(), [
            'tokenDevice' => 'required|string|unique:device_tokens,device_token',
        ])->validate();

        $user = Auth::guard('api')->user();

        $tokenDevice = DeviceToken::create([
            'device_token' => $request->tokenDevice,
            'user_id'      => $user->id
        ]);

        return response([
            'ok' => true,
            'tokenDevice' => $tokenDevice->device_token
        ]);
    }

}
