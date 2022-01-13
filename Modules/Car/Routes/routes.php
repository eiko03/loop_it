<?php



use Illuminate\Support\Facades\Route;
use Modules\Authentication\controllers\AuthController;

Route::group(['prefix' => 'car'], function () {

    Route::post('/', [AuthController::class,'login']);

});
