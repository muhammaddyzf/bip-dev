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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1', 'as' => 'api.'], function () {
    Route::group(['prefix' => '/user', 'as' => 'v1.'], function() {
        Route::post('login', 'API\UserController@login');
        Route::post('register', 'API\UserController@register');
    });

    Route::group(['prefix' => '/produk', 'as' => 'v1.'], function() {
        Route::get('index', 'Api\ProdukController@index');
        Route::get('detail/{id}', 'Api\ProdukController@show');
        Route::get('search', 'Api\ProdukController@getSearchResult');
    }); 

    Route::group(['prefix' => '/ikm', 'as' => 'v1.'], function() {
        Route::get('index', 'Api\IkmController@index');
        Route::get('detail/{id}', 'Api\IkmController@show');
        Route::get('search', 'Api\IkmController@getSearchResult');
    });
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::group(['prefix' => '/v1', 'as' => 'api.'], function () {
        Route::group(['prefix' => '/user', 'as' => 'v1.'], function() {
            // Route::post('details', 'API\UserController@details');
            Route::get('show/{id}', 'Api\UserController@show');
            Route::post('update/{id}', 'Api\UserController@update');
         });
    });
});




// Route::group(['prefix' => '/v1', 'as' => 'api.'], function () {
//     Route::group(['prefix' => '/user', 'as' => 'v1.'], function() {
    	
//     	// route user
//     	Route::post('/login', 'Api\LoginController@index');
//     	Route::post('/register', 'Api\UserController@register');
//     	Route::get('/update/{id}', 'Api\UserController@update');
//     	Route::get('/show/{id}', 'Api\UserController@show');
//     	Route::post('/update/{id}', 'Api\UserController@update');

//     });
// });
