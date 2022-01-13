<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function login(LoginRequest $request)
    {
//        return response()->json($request->email);
        auth()->attempt((array)$request);
//        if (! $token = auth()->attempt((array)$request))
//            return response()->json(['error' => 'Unauthorized'], 401);

//        return $this->respondWithToken($token);
    }

    public function register(RegisterRequest $request)
    {
        User::create($request->toArray());
        return response()->json(['message' => 'Successfully registered']);
    }


    public function me()
    {
        return new UserResource(auth()->user());
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
