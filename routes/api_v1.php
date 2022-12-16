<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\Customer\ItemController;
use App\Http\Controllers\api\v1\Customer\VendorController;
use App\Http\Controllers\api\v1\Customer\CategoryController;
use App\Http\Controllers\api\v1\Customer\CustomerController;
use App\Http\Controllers\api\v1\Customer\MainServiceController;
use App\Http\Controllers\api\v1\Customer\SubCategoryController;
use App\Http\Controllers\Api\v1\Customer\CustomerAuthController;

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

// Route::apiResource('main_services', MainServiceController::class)->only(['index','show']);
// Route::apiResource('categories', CategoryController::class)->only(['index','show']);

Route::group([ 'middleware' => ['auth:customer']], function () {
    Route::post('profile', [CustomerAuthController::class, 'update_profile']);
    Route::post('add_address', [CustomerAuthController::class, 'add_address']);
    Route::post('destroy_address', [CustomerAuthController::class, 'destroy_address']);
    Route::post('check_address', [CustomerAuthController::class, 'check_address']);
    Route::apiResource('main_services', MainServiceController::class)->only(['index','show']);
    Route::apiResource('categories', CategoryController::class)->only(['index','show']);
    Route::apiResource('sub_categories', SubCategoryController::class)->only(['index','show']);
    Route::apiResource('customers', CustomerController::class)->only(['index','show']);
    Route::apiResource('vendors', VendorController::class)->only(['index','show']);
    Route::apiResource('items', ItemController::class)->only(['index','show']);
    
    
});
