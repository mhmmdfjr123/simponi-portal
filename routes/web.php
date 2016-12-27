<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 * Backoffice Routes
 */
Route::group(['prefix' => 'backoffice', 'middleware' => ['web', 'auth', 'acl']], function(){
    Route::get('dashboard', 'Backoffice\DashboardController@index')->name('backoffice-dashboard');

    /*
    Route::controllers([
        'setting/contact'   => 'Backoffice\Setting\ContactController',
        'setting/general'   => 'Backoffice\Setting\GeneralController'
    ]);
    */

    // Profile
    Route::get('profile/edit', 'Backoffice\ProfileController@showEditForm');
    Route::post('profile/edit', 'Backoffice\ProfileController@postEdit');
    Route::get('profile/change-password', 'Backoffice\ProfileController@showChangePasswordForm');
    Route::post('profile/change-password', 'Backoffice\ProfileController@postChangePassword');

    /*
    Route::group(['is' => 'super-administrator'], function () {
        // Administration - Users Routes
        Route::get('administration/user', 'Backoffice\Administration\UserController@index');
        Route::get('administration/user/list-data', 'Backoffice\Administration\UserController@listData');
        Route::get('administration/user/add', 'Backoffice\Administration\UserController@add');
        Route::get('administration/user/edit/{id}', 'Backoffice\Administration\UserController@edit');
        Route::get('administration/user/delete/{id}', 'Backoffice\Administration\UserController@delete');
        Route::get('administration/user/delete-restore/{id}', 'Backoffice\Administration\UserController@deleteRestore');
        Route::get('administration/user/delete-permanent/{id}', 'Backoffice\Administration\UserController@deletePermanent');
        Route::post('administration/user/submit', 'Backoffice\Administration\UserController@submit');
    });

    Route::get('administration/user/check-email/{id?}', 'Backoffice\Administration\UserController@checkEmail');
    Route::get('administration/user/check-username/{id?}', 'Backoffice\Administration\UserController@checkUsername');
    */
});

Route::get('backoffice', function() {
    return Redirect::to('backoffice/dashboard');
});

Route::group(['middleware' => 'web'], function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    // Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    /*
     * Front End Routes
     */
    Route::get('/home', 'HomeController@index');
});