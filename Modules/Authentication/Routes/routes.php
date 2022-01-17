<?php
namespace Modules\Authentication\Routes;


use Illuminate\Support\Facades\Route;
use Modules\Authentication\Controllers\AuthController;

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::get('me', [AuthController::class,'me']);

});
