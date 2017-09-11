<?php

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
/* API AUTH EXAMPLE
Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
*/

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

Route::get('/faq', 'Api\FaqController@index');

Route::group(['prefix' => 'article'], function () {
    Route::get('/category/news', 'Api\Article\CategoryController@news');
    Route::get('/category/promotion', 'Api\Article\CategoryController@promotion');
    Route::get('/{postId}/detail', 'Api\Article\DetailController@detail');
});