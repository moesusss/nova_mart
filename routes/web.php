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
Auth::routes(['register' => false]);

Auth::routes();

Route::group(['prefix'=>'admin', 'middleware' => ['auth']], function () {
    Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //Route::post('logout', 'LoginController@logout')->name('logout');
    
    // User Route
    Route::resource('users', App\Http\Controllers\Backend\UserController::class);
    Route::get('users/{user}/change_status', [App\Http\Controllers\Backend\UserController::class,'changeStatus']);
    
    Route::resource('roles', App\Http\Controllers\Backend\RoleController::class);
    // Main Service Route
    Route::resource('main_services', App\Http\Controllers\Backend\MainServiceController::class);

    Route::get('main_services/{main_service}/change_status', [App\Http\Controllers\Backend\MainServiceController::class,'changeStatus']);

});
