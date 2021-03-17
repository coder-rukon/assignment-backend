<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Auth',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'JwtAuthController@register');
    Route::post('login', 'JwtAuthController@login');
    Route::post('logout', 'JwtAuthController@logout');
    Route::post('refresh', 'JwtAuthController@refresh');
    Route::post('me', 'JwtAuthController@me');

});

Route::group([
    'middleware' => ['api','auth:api'],
    'namespace' => 'App\Http\Controllers\api',
    'prefix' => 'product'

], function ($router) {
    Route::get('get/{id}', 'ProductController@getProduct');
    Route::get('get-all', 'ProductController@AllProducts');
    Route::post('create', 'ProductController@CreateProduct');
    Route::post('update/{id}', 'ProductController@EditProduct');
    Route::post('delete', 'ProductController@DeleteProduct');

});
