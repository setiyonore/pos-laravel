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

Route::get('/',function (){
    return \Inertia\Inertia::render('Auth/Login');
})->middleware('guest');
//prefix "apps"
Route::prefix('apps')->group(function (){
    //middleware "auth"
    Route::group(['middleware' => ['auth']],function (){
        //route dasboard
        Route::get('dashboard',App\Http\Controllers\Apps\DashboardController::class)
            ->name('apps.dasboard');
        //route permissions
        Route::get('/permissions', \App\Http\Controllers\Apps\PermissionController::class)->name('apps.permissions.index')
            ->middleware('permission:permissions.index');
        //route resource roles
        Route::resource('/roles', \App\Http\Controllers\Apps\RoleController::class, ['as' => 'apps'])
            ->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');
         //route resource users
        Route::resource('/users', \App\Http\Controllers\Apps\UserController::class, ['as' => 'apps'])
            ->middleware('permission:users.index|users.create|users.edit|users.delete');
        //route resource categories
        Route::resource('/categories',\App\Http\Controllers\Apps\CategoryController::class, ['as' => 'apps'])
        ->middleware('permission:categories.index|categories.create|categories.edit|categories.delete');

        //route resource products
        Route::resource('/products',\App\Http\Controllers\Apps\ProductController::class,['as' => 'apps'])
        ->middleware('permission:products.index|products.create|products.edit|products.delete');
    });
});
