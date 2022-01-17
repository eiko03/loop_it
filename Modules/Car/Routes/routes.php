<?php
namespace Modules\Car\Routes;


use Illuminate\Support\Facades\Route;
use Modules\Car\Controllers\CarController;

Route::group(['prefix' => 'car'], function () {

    Route::get('/', [CarController::class,'index']);
    Route::delete('/{id}', [CarController::class,'destroy']);
    Route::get('/{id}', [CarController::class,'retrieve']);
    Route::post('/', [CarController::class,'create']);
    Route::put('/{id}', [CarController::class,'update']);

});
