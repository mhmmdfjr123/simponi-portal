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


/*
|--------------------------------------------------------------------------
| Front End Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Redirect::route('home');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/content', 'ContentController@index')->name('content');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/simulation', 'ContentController@simulation')->name('simulation');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/customer', 'CustomerController@index')->name('customer');
});

Route::group(['prefix' => 'portal', 'middleware' => ['web', 'auth.portal']], function () {
    Route::get('/dashboard', 'Portal\DashboardController@index')->name('portal-dashboard');
});

Route::group(['prefix' => 'portal', 'middleware' => 'web'], function () {
    Route::get('/login', 'Portal\Auth\LoginController@showLoginForm')->name('portal-login');
    Route::post('/login', 'Portal\Auth\LoginController@login');
    Route::get('/login/register', 'Portal\Auth\LoginController@showRegistrationForm')->name('portal-register');
    Route::post('/login/register', 'Portal\Auth\LoginController@register');
    Route::get('/logout', 'Portal\Auth\LoginController@logout')->name('portal-logout');
    Route::get('/password/reset', 'Portal\Auth\LoginController@logout')->name('portal-forgot-password');
    Route::post('/password/reset', 'Portal\Auth\LoginController@register');
    Route::get('/password/login-token', 'Portal\Auth\LoginController@logout')->name('portal-login-token');
    Route::post('/password/login-token', 'Portal\Auth\LoginController@register');
});

/*
|--------------------------------------------------------------------------
| BackOffice Routes
|--------------------------------------------------------------------------
*/
Route::get('backoffice', function() {
    return Redirect::to('backoffice/dashboard');
})->name('backoffice');

Route::group(['prefix' => 'backoffice', 'middleware' => ['web', 'auth', 'acl']], function(){
    Route::get('dashboard', 'Backoffice\DashboardController@index')->name('backoffice-dashboard');

    // Profile
    Route::get('profile/edit', 'Backoffice\ProfileController@showEditForm');
    Route::post('profile/edit', 'Backoffice\ProfileController@postEdit');
    Route::get('profile/change-password', 'Backoffice\ProfileController@showChangePasswordForm');
    Route::post('profile/change-password', 'Backoffice\ProfileController@postChangePassword');

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

    Route::get('post/category', 'Backoffice\Post\CategoryController@index');
    Route::get('post/category/list-data', 'Backoffice\Post\CategoryController@listData');
    Route::get('post/category/add', 'Backoffice\Post\CategoryController@add');
    Route::get('post/category/{id}/edit', 'Backoffice\Post\CategoryController@edit');
    Route::post('post/category/submit', 'Backoffice\Post\CategoryController@submit');
    Route::get('post/category/{id}/delete', 'Backoffice\Post\CategoryController@delete');

    Route::get('pages', 'Backoffice\Page\PageController@index');
    Route::get('pages/list-data', 'Backoffice\Page\PageController@listData');
    Route::get('pages/add', 'Backoffice\Page\PageController@showNewForm');
    Route::get('pages/edit/{id}', 'Backoffice\Page\PageController@showEditForm');
    Route::post('pages/submit', 'Backoffice\Page\PageController@submit');
    Route::get('pages/delete/{id}', 'Backoffice\Page\PageController@delete');
    Route::get('pages/delete/{id}/restore', 'Backoffice\Page\PageController@restoreDeletedData');
    Route::get('pages/delete/{id}/force', 'Backoffice\Page\PageController@forceDelete');
});

Route::group(['middleware' => 'web'], function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    // Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    // Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password-reset');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});
