<?php

use Illuminate\Http\Request;

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

Route::post('register', 'API\JwtController@register')->middleware('log');
Route::post('login', 'API\JwtController@login')->middleware('log');
Route::group(['middleware' => ['jwt.auth', 'log']], function () {
    Route::get('user-login','API\JwtController@getUser')->name('jwt.user');
    Route::resource('users', 'API\UserController', ['except' => [ 'show' ]]);
    Route::resource('roles', 'API\RoleController', ['except' => [ 'show' ]]);
    Route::resource('categories', 'API\CategoryController', ['except' => [ 'show' ]]);
    Route::post('categories/{id}', 'API\CategoryController@update')->name('categories.update');
    Route::resource('posts', 'API\PostController', ['except' => [ 'show','update' ]]);
    Route::post('posts/{id}', 'API\PostController@update')->name('posts.update');
    Route::resource('gallery', 'API\GalleryController', ['except' => [ 'show','update' ]]);
    Route::post('gallery/{gallery}', 'API\GalleryController@update')->name('gallery.update');
    Route::resource('image', 'API\ImageController', ['except' => [ 'show','update' ]]);
    Route::post('image/{image}', 'API\ImageController@update')->name('image.update');
    Route::resource('product', 'API\ProductController', ['except' => [ 'show','update' ]]);
    Route::post('product/{product}', 'API\ProductController@update')->name('product.update');
    Route::resource('cooking', 'API\CookingController', ['except' => [ 'show','update' ]]);
    Route::post('cooking/{cooking}', 'API\CookingController@update')->name('cooking.update');
    Route::resource('page', 'API\PageController', ['only' => [ 'index' ]]);
    Route::post('page/addComponent', 'API\PageController@addComponent')->name('page.addComponent');
    Route::delete('page/deleteComponent/{id}', 'API\PageController@deleteComponent')->name('page.deleteComponent');
    Route::get('page/listComponent', 'API\PageController@listComponent')->name('page.listComponent');
});
