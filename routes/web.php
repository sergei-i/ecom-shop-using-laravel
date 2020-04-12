<?php

use App\Http\Controllers\ResetController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]); // сократили кол-во auth маршрутов

Route::get('reset', [ResetController::class, 'reset'])->name('reset');

Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');

Route::middleware(['auth'])->group(function () {
    Route::group([
        'namespace' => 'Person',
        'prefix' => 'person',
        'as' => 'person.'
    ], function () {
        Route::get('/orders', 'OrderController@index')->name('orders.index');
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    });

    Route::group([
        'middleware' => ['is_admin'],
        'namespace' => 'Admin',
        'prefix' => 'admin'
    ], function () {
        Route::get('/orders', 'OrderController@index')->name('orders');
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');

        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
    });
});

Route::get('/', 'MainController@index')->name('index');
Route::get('/categories', 'MainController@categories')->name('categories');

Route::group(['prefix' => 'basket'], function () {
    Route::post('/add/{id}', 'BasketController@basketAdd')->name('basket-add');

    Route::group([
        'middleware' => 'basket_not_empty',
    ], function () {
        Route::get('/', 'BasketController@basket')->name('basket');
        Route::get('/place', 'BasketController@basketPlace')->name('basket-place');
        Route::post('/remove/{id}', 'BasketController@basketRemove')->name('basket-remove');
        Route::post('/confirm', 'BasketController@basketConfirm')->name('basket-confirm');
    });
});

Route::get('/{category}', 'MainController@category')->name('category');
Route::get('/{category}/{product?}', 'MainController@product')->name('product');

Route::get('/home', 'HomeController@index')->name('home');
