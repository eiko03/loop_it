<?php
namespace Modules\Car\Routes;


use Illuminate\Support\Facades\Route;
use Modules\Car\Controllers\CarController;

Route::group(['prefix' => 'car'], function () {

    Route::get('/', [CarController::class,'index']);

});
