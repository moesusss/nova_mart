<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerAuthController;
use App\Http\Controllers\api\v1\Customer\CategoryController;
use App\Http\Controllers\api\v1\Customer\MainServiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/otp_request',[App\Http\Controllers\Api\v1\Customer\CustomerAuthController::class, 'otpRequest']);
Route::post('/otp_verify',[App\Http\Controllers\Api\v1\Customer\CustomerAuthController::class, 'otpVerify']);
Route::post('/register',[App\Http\Controllers\Api\v1\Customer\CustomerAuthController::class, 'register']);
Route::post('/login',[App\Http\Controllers\Api\v1\Customer\CustomerAuthController::class, 'login']);

Route::apiResource('main_services', MainServiceController::class)->only(['index','show']);
Route::apiResource('categories', CategoryController::class)->only(['index','show']);

Route::group([ 'middleware' => ['auth:customer']], function () {
    // Route::apiResource('main_services', MainServiceController::class)->only(['index','show']);
    // Route::apiResource('categories', CategoryController::class)->only(['index','show']);
    
});
