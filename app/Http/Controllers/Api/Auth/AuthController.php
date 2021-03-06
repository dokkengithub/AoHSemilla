<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\UserLoginRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        if( ! Auth::attempt($request->only(['email', 'password'])) ){ //Si el usuario no existe
            throw new AuthenticationException('Credenciales inválidas');
        }

        $token = $request->user()->createToken('authToken')->plainTextToken;

        return response()->json(
            [
                'status'    =>  true,
                'token'     =>  $token,
                'message'     =>  "Login",
            ],
            201
        );
    }

    public function logout(Request $request)
    {
        // Revoke all tokens...
        //$user->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        //$request->user()->currentAccessToken()->delete();

        // Revoke a specific token...
        //$user->tokens()->where('id', $tokenId)->delete();

        //$request->user()->currentAccessToken()->delete();
        $request->user()->currentAccessToken()->delete();
        //Auth::logout();

        return response()->json([
            'status'    =>  true,
            'message' => 'Ha cerrado sesión.'
        ], 200);
    }

    public function user(){
        return response()->json(
            [
                'status'   =>  Auth::check(),
                'data'     =>  Auth::user()
            ],
            200
        );
    }
}
