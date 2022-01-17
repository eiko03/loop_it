<?php
namespace Modules\Authentication\Controllers;


use Illuminate\Routing\Controller;
use Modules\Authentication\Models\User;
use Modules\Authentication\Requests\LoginRequest;
use Modules\Authentication\Requests\RegisterRequest;
use Modules\Authentication\Resources\UserResource;
use Modules\Authentication\Rules\CheckIfUserExistsRule;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function login(LoginRequest $request)
    {

        $request->validate([
            'email'=>new CheckIfUserExistsRule()
        ]);

        $token=auth()->attempt($request->all());
        if (!$token)
            return response()->json(['error' => 'Password Or Email Does Not Match'], 401);

        return $this->respondWithToken($token);
    }

    public function register(RegisterRequest $request)
    {
        User::create(array_merge(
            $request->toArray(),
            ['password' => bcrypt($request->password)]
        ));
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
            'access_token' => 'bearer '.$token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
