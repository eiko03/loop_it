<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Authentication\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

enum Auth: string
{
    case email="admin@gmail.com";
    case password="123Qaw@!!9Io09ZZ";
}

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_home()
    {
        $response = $this->json('GET', 'api/no-url');

        $response->assertStatus(404);
    }

    public function test_unauthenticated()
    {
        $response = $this->json('GET', '/api/auth/me/');

        $response->assertStatus(401);
    }

    public function test_login()
    {
        $baseUrl = "/api/auth/login";

        $response = $this->json('POST', $baseUrl . '/', [
            'email' => Auth::email,
            'password' => Auth::password
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'expires_in'
            ]);
    }

    public function testLogout()
    {
        $user = User::where('email', Auth::email)->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = '/api/auth/logout?token=' . $token;

        $response = $this->json('POST', $baseUrl, []);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'Successfully logged out'
            ]);
    }

    public function test_GetCars()
    {
        $user = User::where('email', Auth::email)->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = '/api/car?token=' . $token;

        $response = $this->json('GET', $baseUrl . '/', []);

        $response->assertStatus(200);
    }
}
