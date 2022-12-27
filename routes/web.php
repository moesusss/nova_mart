<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(['register' => false]);

Auth::routes();

Route::group(['prefix'=>'admin', 'middleware' => ['auth']], function () {
    
    //Route::post('logout', 'LoginController@logout')->name('logout');
    
    // User Route
    Route::resource('users', App\Http\Controllers\Backend\UserController::class);
    Route::get('users/{user}/change_status', [App\Http\Controllers\Backend\UserController::class,'changeStatus']);
    // User Route
    Route::resource('roles', App\Http\Controllers\Backend\RoleController::class);
    // Main Service Route
    Route::resource('main_services', App\Http\Controllers\Backend\MainServiceController::class);
    Route::get('main_services/{main_service}/change_status', [App\Http\Controllers\Backend\MainServiceController::class,'changeStatus']);
    // CategoryRoute
    Route::resource('categories', App\Http\Controllers\Backend\CategoryController::class);
    Route::get('categories/{category}/change_status', [App\Http\Controllers\Backend\CategoryController::class,'changeStatus']);
    // Sub CategoryRoute
    Route::resource('sub_categories', App\Http\Controllers\Backend\SubCategoryController::class);
    Route::get('sub_categories/{sub_category}/change_status', [App\Http\Controllers\Backend\SubCategoryController::class,'changeStatus']);
    Route::get('sub_categories/getDataByCategoryID/{id}', [App\Http\Controllers\Backend\SubCategoryController::class,'getDataByCategoryID']);
    // Brand Route
    Route::resource('brands', App\Http\Controllers\Backend\BrandController::class);
    Route::get('brands/{brand}/change_status', [App\Http\Controllers\Backend\BrandController::class,'changeStatus']);
    Route::get('brands/getDataBySubCategoryID/{id}', [App\Http\Controllers\Backend\BrandController::class,'getDataBySubCategoryID']);
    // Hub Vendor Route
    Route::resource('hub_vendors', App\Http\Controllers\Backend\HubVendorController::class);
    Route::get('hub_vendors/{hub_vendor}/change_status', [App\Http\Controllers\Backend\HubVendorController::class,'changeStatus']);
    // Vendor Route
    Route::resource('vendors', App\Http\Controllers\Backend\VendorController::class);
    Route::get('vendors/{vendor}/change_status', [App\Http\Controllers\Backend\VendorController::class,'changeStatus']);
    // Item
    Route::resource('items', App\Http\Controllers\Backend\ItemController::class);
    Route::get('items/{item}/change_status', [App\Http\Controllers\Backend\ItemController::class,'changeStatus']);
    Route::get('items/getDataByVendorID/{id}', [App\Http\Controllers\Backend\ItemController::class,'getDataByVendorID']);
    // Item Stock
    Route::resource('item_stocks', App\Http\Controllers\Backend\ItemStockController::class);
    // Customer
    Route::resource('customers', App\Http\Controllers\Backend\CustomerController::class);
    Route::get('customers/{customer}/change_status', [App\Http\Controllers\Backend\CustomerController::class,'changeStatus']);
    // Delivery Fees
    Route::resource('delivery_fees', App\Http\Controllers\Backend\DeliveryFeeController::class);
    Route::get('delivery_fees/{delivery_fee}/change_status', [App\Http\Controllers\Backend\DeliveryFeeController::class,'changeStatus']);
});
