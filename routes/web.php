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
| BackOffice Routes
|--------------------------------------------------------------------------
*/
Route::get('backoffice', function() {
    return Redirect::to('backoffice/dashboard');
})->name('backoffice');

Route::group(['prefix' => 'backoffice', 'middleware' => ['web', 'auth', 'acl'], 'as' => 'backoffice.'], function(){
    Route::get('dashboard', 'Backoffice\DashboardController@index')->name('dashboard');
	Route::get('dashboard/analytics/counter', 'Backoffice\DashboardController@getCounterAnalytics');
	Route::get('dashboard/analytics/graph', 'Backoffice\DashboardController@getGraphAnalytics');

    // Profile
    Route::get('profile/edit', 'Backoffice\ProfileController@showEditForm');
    Route::post('profile/edit', 'Backoffice\ProfileController@postEdit');
    Route::get('profile/change-password', 'Backoffice\ProfileController@showChangePasswordForm');
    Route::post('profile/change-password', 'Backoffice\ProfileController@postChangePassword');

    // Post
    Route::get('post', 'Backoffice\Post\PostController@index');
    Route::get('post/list-data', 'Backoffice\Post\PostController@listData');
    Route::get('post/add', 'Backoffice\Post\PostController@add');
    Route::get('post/{id}/edit', 'Backoffice\Post\PostController@edit');
    Route::post('post/submit', 'Backoffice\Post\PostController@submit');
    Route::get('post/{id}/delete', 'Backoffice\Post\PostController@delete');
    Route::get('post/{id}/delete/restore', 'Backoffice\Post\PostController@restoreDeletedData');
    Route::get('post/{id}/delete/force', 'Backoffice\Post\PostController@forceDelete');

    Route::get('post/category', 'Backoffice\Post\CategoryController@index');
    Route::get('post/category/list-data', 'Backoffice\Post\CategoryController@listData');
    Route::get('post/category/add', 'Backoffice\Post\CategoryController@add');
    Route::get('post/category/{id}/edit', 'Backoffice\Post\CategoryController@edit');
    Route::post('post/category/submit', 'Backoffice\Post\CategoryController@submit');
    Route::get('post/category/{id}/delete', 'Backoffice\Post\CategoryController@delete');

    // Pages
    Route::group(['prefix' => 'pages', 'as' => 'page.'], function() {
        Route::get('/', 'Backoffice\Page\PageController@index')->name('index');
        Route::get('/list-data', 'Backoffice\Page\PageController@listData');
        Route::get('/add', 'Backoffice\Page\PageController@showNewForm')->name('add');
        Route::get('/{id}/edit', 'Backoffice\Page\PageController@showEditForm')->name('edit');
        Route::group(['can' => 'approve.page'], function() {
            Route::post('/submit', 'Backoffice\Page\PageController@submit')->name('submit');
        });
        Route::group(['can' => 'delete.page'], function() {
            Route::get('/{id}/delete', 'Backoffice\Page\PageController@delete')->name('delete');
            Route::get('/{id}/delete/restore', 'Backoffice\Page\PageController@restoreDeletedData')->name('delete-restore');
            Route::get('/{id}/delete/force', 'Backoffice\Page\PageController@forceDelete')->name('delete-force');
        });

        // Pages - revision
        Route::group(['prefix' => 'revision', 'as' => 'revision.'], function() {
            Route::get('/', 'Backoffice\Page\PageRevisionController@index')->name('index');
            Route::get('/list-data', 'Backoffice\Page\PageRevisionController@listData')->name('list-data');
            Route::get('/add/{pageId?}', 'Backoffice\Page\PageRevisionController@showNewForm')->name('add');
            Route::get('/{pageRevision}/edit', 'Backoffice\Page\PageRevisionController@showEditForm')->name('edit');
            Route::post('/submit', 'Backoffice\Page\PageRevisionController@submit')->name('submit');
            Route::get('/{pageRevision}/delete', 'Backoffice\Page\PageRevisionController@delete')->name('delete');
            Route::get('/approval', 'Backoffice\Page\PageRevisionController@approval')->name('approval');
            Route::get('/approval/list', 'Backoffice\Page\PageRevisionController@approvalList')->name('approval-list');
        });
    });

    // File - Download
	Route::get('file/download', 'Backoffice\File\DownloadController@index');
	Route::get('file/download/list-data', 'Backoffice\File\DownloadController@listData');
	Route::get('file/download/add', 'Backoffice\File\DownloadController@add');
	Route::get('file/download/{id}/edit', 'Backoffice\File\DownloadController@edit');
	Route::post('file/download/submit', 'Backoffice\File\DownloadController@submit');
	Route::get('file/download/{id}/delete', 'Backoffice\File\DownloadController@delete');

	Route::get('file/download/category', 'Backoffice\File\DownloadCategoryController@index');
	Route::get('file/download/category/list-data', 'Backoffice\File\DownloadCategoryController@listData');
	Route::get('file/download/category/add', 'Backoffice\File\DownloadCategoryController@add');
	Route::get('file/download/category/{id}/edit', 'Backoffice\File\DownloadCategoryController@edit');
	Route::post('file/download/category/submit', 'Backoffice\File\DownloadCategoryController@submit');
	Route::get('file/download/category/{id}/delete', 'Backoffice\File\DownloadCategoryController@delete');

    // Support - FAQ
	Route::get('support/faq', 'Backoffice\Support\FaqController@index');
	Route::get('support/faq/show', 'Backoffice\Support\FaqController@showFaq');
	Route::post('support/faq/re-order', 'Backoffice\Support\FaqController@reOrderFaqItems');
	Route::get('support/faq/add/with-category/{faqCategoryId}', 'Backoffice\Support\FaqController@addItem');
	Route::get('support/faq/{id}/edit', 'Backoffice\Support\FaqController@editItem');
	Route::post('support/faq/submit', 'Backoffice\Support\FaqController@submitItem');
	Route::get('support/faq/{id}/delete', 'Backoffice\Support\FaqController@deleteItem');
	Route::get('support/faq/category/add', 'Backoffice\Support\FaqController@addCategory');
	Route::get('support/faq/category/{id}/edit', 'Backoffice\Support\FaqController@editCategory');
	Route::post('support/faq/category/submit', 'Backoffice\Support\FaqController@submitCategory');
	Route::get('support/faq/category/{id}/delete', 'Backoffice\Support\FaqController@deleteCategory');
	Route::post('support/faq/category/re-order', 'Backoffice\Support\FaqController@reOrderFaqCategories');

    Route::group(['is' => 'super-administrator'], function () {
        // Layout - Menu
        Route::get('layout/menu', 'Backoffice\Layout\MenuController@index');
        Route::get('layout/menu/list-menu', 'Backoffice\Layout\MenuController@listMenu');
        Route::post('layout/menu/menu-index', 'Backoffice\Layout\MenuController@menuIndex');
        Route::get('layout/menu/add', 'Backoffice\Layout\MenuController@add');
        Route::get('layout/menu/edit/{id}', 'Backoffice\Layout\MenuController@edit');
        Route::post('layout/menu/submit', 'Backoffice\Layout\MenuController@submit');
        Route::get('layout/menu/delete', 'Backoffice\Layout\MenuController@delete');
        Route::get('layout/menu/add-cat', 'Backoffice\Layout\MenuController@addCategory');
        Route::get('layout/menu/edit-cat/{id}', 'Backoffice\Layout\MenuController@editCategory');
        Route::get('layout/menu/delete-cat/{id}', 'Backoffice\Layout\MenuController@deleteCategory');
        Route::post('layout/menu/submit-cat', 'Backoffice\Layout\MenuController@submitCategory');

        // Layout - Banner Management
        Route::get('layout/banner', 'Backoffice\Layout\BannerController@index');
        Route::post('layout/banner/re-order', 'Backoffice\Layout\BannerController@reOrder');
        Route::get('layout/banner/add', 'Backoffice\Layout\BannerController@showNewForm');
        Route::post('layout/banner/submit', 'Backoffice\Layout\BannerController@submit');
        Route::get('layout/banner/{banner}/edit', 'Backoffice\Layout\BannerController@edit');
        Route::get('layout/banner/{banner}/delete', 'Backoffice\Layout\BannerController@delete');
        Route::get('layout/banner/{banner}/crop', 'Backoffice\Layout\BannerController@showCroppingCanvas');
        Route::post('layout/banner/{banner}/crop', 'Backoffice\Layout\BannerController@cropImage');

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
});

// BackOffice Credentials
Route::group(['middleware' => 'web'], function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

	// Password Reset Routes...
	$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	$this->post('password/reset', 'Auth\ResetPasswordController@reset');
});

/*
|--------------------------------------------------------------------------
| Front End Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Redirect::route('home');
});

// Portal
Route::get('/portal', function () {
	return Redirect::route('portal-dashboard');
});

Route::group(['prefix' => 'portal', 'middleware' => ['web', 'auth.portal']], function () {
	Route::get('/dashboard', 'Portal\DashboardController@showDashboard')->name('portal-dashboard');

	Route::get('/mutation', 'Portal\MutationController@showMutations')->middleware('portal.account.individual')->name('portal-mutation');
	Route::post('/mutation', 'Portal\MutationController@getMutations')->middleware('portal.account.individual');

	Route::get('/report', 'Portal\ReportController@showDownloadList')->middleware('portal.account.company')->name('portal-report');
	Route::get('/report/download/{filename}', 'Portal\ReportController@download')->middleware('portal.account.company')->name('portal-report-download');

	Route::get('/profile', 'Portal\ProfileController@showProfile')->name('portal-profile');
	Route::post('/profile', 'Portal\ProfileController@saveNewProfile');
	Route::get('profile/change-password', 'Portal\ProfileController@showChangePasswordForm')->name('portal-change-password');
	Route::post('profile/change-password', 'Portal\ProfileController@changePassword');
});

// Portal - Auth
Route::group(['prefix' => 'portal', 'middleware' => 'web'], function () {
    Route::get('/login', 'Portal\Auth\LoginController@showLoginForm')->name('portal-login');
    Route::post('/login', 'Portal\Auth\LoginController@login');
    Route::get('/login/register', 'Portal\Auth\LoginController@showRegistrationForm')->name('portal-register');
    Route::post('/login/register', 'Portal\Auth\LoginController@register');
    Route::get('/logout', 'Portal\Auth\LoginController@logout')->name('portal-logout');
    Route::get('/password/forgot', 'Portal\Auth\ForgotPasswordController@showForgotPasswordForm')->name('portal-forgot-password');
    Route::post('/password/forgot', 'Portal\Auth\ForgotPasswordController@requestToken');
    Route::get('/password/reset', 'Portal\Auth\ForgotPasswordController@showResetPasswordForm')->name('portal-reset-password');
    Route::post('/password/reset', 'Portal\Auth\ForgotPasswordController@resetPassword');

	Route::get('/activation/company/{activationCode?}', 'Portal\Auth\ActivationController@showCompanyActivationForm')->name('portal-activation-company');
	Route::post('/activation/company', 'Portal\Auth\ActivationController@activateCompany')->name('portal-activation-company-activate');

    Route::get('/activation/perorangan/{activationCode}', 'Portal\Auth\ActivationController@activateIndividualAccount')->name('portal-activation-individual');
});

// Branch
Route::get('/branch', function () {
	return Redirect::route('branch-dashboard');
});
Route::group(['prefix' => 'branch', 'middleware' => ['web', 'auth.branch']], function () {
	Route::get('/dashboard', 'Branch\DashboardController@showDashboard')->name('branch-dashboard');

	Route::get('/account/portal/search', 'Branch\AccountManagement\AccountSearchingController@showPortalAccountForm')->name('branch-search-portal-account');

	Route::post('/account/individual/search', 'Branch\AccountManagement\IndividualAccountController@searchAccount')->name('branch-search-individual-account');
	Route::get('/account/individual/{encryptedId}', 'Branch\AccountManagement\IndividualAccountController@showAccount')->name('branch-individual-account');
	Route::get('/account/individual/{encryptedId}/activate', 'Branch\AccountManagement\IndividualAccountController@activateAccount')->name('branch-individual-account-activate');
	Route::get('/account/individual/{encryptedId}/change-email', 'Branch\AccountManagement\IndividualAccountController@showChangeEmailForm')->name('branch-individual-account-change-email');
	Route::post('/account/individual/{encryptedId}/change-email', 'Branch\AccountManagement\IndividualAccountController@changeEmail');
	Route::get('/account/individual/{encryptedId}/block', 'Branch\AccountManagement\IndividualAccountController@blockAccount')->name('branch-individual-account-block');
	Route::get('/account/individual/{encryptedId}/unblock', 'Branch\AccountManagement\IndividualAccountController@unblockAccount')->name('branch-individual-account-unblock');
	Route::get('/account/individual/{encryptedId}/delete', 'Branch\AccountManagement\IndividualAccountController@deleteAccount')->name('branch-individual-account-delete');

	Route::post('/account/company/search', 'Branch\AccountManagement\CompanyAccountController@searchAccount')->name('branch-search-company-account');
	Route::get('/account/company/{encryptedId}', 'Branch\AccountManagement\CompanyAccountController@showAccount')->name('branch-company-account');
	Route::get('/account/company/{encryptedId}/register', 'Branch\AccountManagement\CompanyAccountController@showAccountForRegistration')->name('branch-company-registration');
	Route::post('/account/company/{encryptedId}/register', 'Branch\AccountManagement\CompanyAccountController@register');
	Route::get('/account/company/{encryptedId}/block', 'Branch\AccountManagement\CompanyAccountController@blockAccount')->name('branch-company-account-block');
	Route::get('/account/company/{encryptedId}/unblock', 'Branch\AccountManagement\CompanyAccountController@unblockAccount')->name('branch-company-account-unblock');
	Route::get('/account/company/{encryptedId}/delete', 'Branch\AccountManagement\CompanyAccountController@deleteAccount')->name('branch-company-account-delete');

	Route::get('/account/branch/search', 'Branch\AccountManagement\AccountSearchingController@showBranchAccountForm')->name('branch-search-account');
	Route::post('/account/branch/search', 'Branch\AccountManagement\BranchAccountController@searchAccount');
	Route::get('/account/branch/{encryptedId}', 'Branch\AccountManagement\BranchAccountController@showAccount')->name('branch-account');
	Route::get('/account/branch/{encryptedId}/block', 'Branch\AccountManagement\BranchAccountController@blockAccount')->name('branch-account-block');
	Route::get('/account/branch/{encryptedId}/unblock', 'Branch\AccountManagement\BranchAccountController@unblockAccount')->name('branch-account-unblock');
	Route::get('/account/branch/{encryptedId}/delete', 'Branch\AccountManagement\BranchAccountController@deleteAccount')->name('branch-account-delete');
});

// Branch - Auth
Route::group(['prefix' => 'branch', 'middleware' => 'web'], function () {
	Route::get('/login', 'Branch\Auth\LoginController@showLoginForm')->name('branch-login');
	Route::post('/login', 'Branch\Auth\LoginController@login');
	Route::get('/login/register', 'Branch\Auth\LoginController@showRegistrationForm')->name('branch-register');
	Route::post('/login/register', 'Branch\Auth\LoginController@register');
	Route::get('/logout', 'Branch\Auth\LoginController@logout')->name('branch-logout');
});

// Front Site
Route::group(['middleware' => 'web'], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/faq', 'FaqController@index')->name('faq');
    Route::get('/category/{alias?}', 'PostController@index')->name('post-category');
    Route::get('/post/{alias}', 'PostController@detail')->name('post');

	Route::get('/download', 'DownloadController@index')->name('download-list');
	Route::get('/download/category/{categoryAlias}', 'DownloadController@index')->name('download-category');
	Route::get('/download/get/{filename}', 'DownloadController@getFile')->name('download-file');

	Route::get('/simulation', 'SimulationController@showSimulationBasedOnContrib')->name('simulation');
	Route::get('/simulation/based-on-needs', 'SimulationController@showSimulationBasedOnNeeds');

	Route::get('/{alias}', 'PageController@index');
});