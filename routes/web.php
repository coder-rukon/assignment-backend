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
    return view('welcome');
});

Route::group([
        'middleware' => ['auth'],
        'prefix' => 'my-account'
    ],
    function(){
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
        Route::group([
            'prefix' => "product",
            'namespace' => 'App\Http\Controllers'
        ],
        function(){
            Route::get('all','ProductController@Index')->name('product.list');
            Route::get('create','ProductController@CreateProduct')->name('product.create');
            Route::post('create','ProductController@CreateProductRequest')->name('product.create.request');
            Route::get('edit/{id}','ProductController@EditProduct')->name('product.edit');
            Route::post('edit/{id}','ProductController@EditProductRequest')->name('product.edit.request');
        });
    }
);

require __DIR__.'/auth.php';
