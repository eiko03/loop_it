<?php

namespace Tests\Unit;

use Modules\Authentication\Models\User;
use Modules\Car\Models\Car;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

enum Auth: string
{
    case email="admin@gmail.com";
}

class ExampleTest extends TestCase
{

    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_carSort()
    {
        $first_car=Car::OrderBy('id','ASC')->first();
        $user = User::where('email', Auth::email)->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = '/api/car?token=' . $token.'&sort=ASC&sort_by=id';
        $response = $this->json('GET', $baseUrl . '/');
        $this->assertEquals($first_car->id,$response->getData()->data[0]->id);
    }

    public function test_carSearch()
    {
        $first_car=Car::OrderBy('id','ASC')->where(function ($query)  {
            $query->where('model','LIKE', '%' .'a'. '%')->orWhere('brand','LIKE', '%' .'a'. '%');
        })->first();
        $user = User::where('email', Auth::email)->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = '/api/car?token=' . $token.'&search=a&sort=ASC&sort_by=id';
        $response = $this->json('GET', $baseUrl . '/');
        $this->assertEquals($first_car->id,$response->getData()->data[0]->id);
    }
}
