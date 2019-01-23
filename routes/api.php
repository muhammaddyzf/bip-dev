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
        Route::post('login', 'Api\UserController@login');
        Route::post('register', 'Api\UserController@register');
    });

    Route::group(['prefix' => '/produk', 'as' => 'v1.'], function() {
        Route::get('index', 'Api\ProdukController@index');
        Route::get('detail/{id}', 'Api\ProdukController@show');
        Route::get('search', 'Api\ProdukController@getSearchResult');

        Route::get('like/{idProduk}/{idUser}', 'Api\ProdukController@likeProduk');
        Route::get('rating/{idProduk}/{idUser}/{rating}', 'Api\ProdukController@ratingProduk');
        Route::get('like-detail/{id}', 'Api\ProdukController@detailLike');

        Route::get('ikm/{id}', 'Api\IkmController@listProduk');
    }); 

    Route::group(['prefix' => '/ikm', 'as' => 'v1.'], function() {
        Route::get('index', 'Api\IkmController@index');
        Route::get('detail/{id}', 'Api\IkmController@show');
        Route::get('search', 'Api\IkmController@getSearchResult');


        Route::get('agenda/{id}/{keyword}/index', 'Api\EventController@index');
        Route::get('agenda/detail/{id}', 'Api\EventController@show');
        Route::post('agenda/scan', 'Api\EventController@scan');
    });


    Route::group(['prefix' => '/user', 'as' => 'v1.'], function() {
        Route::post('update', 'Api\IkmController@updateUser');
     });
});

Route::group(['middleware' => ['api', 'auth:api']], function(){
    Route::group(['prefix' => '/v1', 'as' => 'api.'], function () {
        Route::group(['prefix' => '/user', 'as' => 'v1.'], function() {
            Route::get('show/{id}', 'Api\UserController@show');
            // Route::post('update', 'Api\UserController@update');
         });
    });
});
