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


// Home routes
Route::get('/', [
    'uses' => '\Brood\Http\Controllers\HomeController@getIndex',
    'as' => 'home',
]);
Route::post('/broodverwijderen', [
    'uses' => '\Brood\Http\Controllers\HomeController@postRemoveUnsendOrder',
    'as' => 'user.bread.removeorder',
    'middleware' => ['auth'],
]);
// redirect home
Route::get('/login', [
    'uses' => '\Brood\Http\Controllers\HomeController@getIndex',
]);
Route::get('/home', [
    'uses' => '\Brood\Http\Controllers\HomeController@getIndex',
]);


// Athentication routes
Route::post('/', [
    'uses' => '\Brood\Http\Controllers\AuthController@postSignin',
]);

Route::get('/logout', [
    'uses' => '\Brood\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout',
]);

// Account routes
Route::get('/signup', [
    'uses' => '\Brood\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup',
    'middleware' => ['guest'],
]);
Route::post('/signup', [
    'uses' => '\Brood\Http\Controllers\AuthController@postSignup',
    'middleware' => ['guest'],
]);

// Orders routes
Route::get('/bestellen', [
    'uses' => '\Brood\Http\Controllers\OrderController@getOrder',
    'as' => 'user.bread.order',
    'middleware' => ['auth'],
]);
Route::post('/bestellen', [
    'uses' => '\Brood\Http\Controllers\OrderController@postOrder',
    'middleware' => ['auth'],
]);
Route::get('/bestellingen', [
    'uses' => '\Brood\Http\Controllers\OrderController@getRecentOrders',
    'as' => 'user.recentorders',
    'middleware' => ['auth'],
]);
Route::get('/admin/bestellingen', [
    'uses' => '\Brood\Http\Controllers\OrderController@getChangeOrder',
    'as' => 'admin.user.changeorder',
    'middleware' => ['auth'],
]);
Route::post('/admin/bestellingen', [
    'uses' => '\Brood\Http\Controllers\OrderController@postChangeOrder',
    'as' => 'admin.user.changeorder',
    'middleware' => ['auth'],
]);

// Bills routes
Route::get('/rekening', [
    'uses' => '\Brood\Http\Controllers\BillController@getBill',
    'as' => 'user.bread.bill',
    'middleware' => ['auth'],
]);
Route::get('/maandrekening', [
    'uses' => '\Brood\Http\Controllers\BillController@getMonthBill',
    'as' => 'user.bread.monthbill',
    'middleware' => ['auth'],
]);
Route::get('/admin/rekeningen', [
    'uses' => '\Brood\Http\Controllers\BillController@getUserBills',
    'as' => 'admin.user.bills',
    'middleware' => ['auth'],
]);

// Broodrooster routes
Route::get('/broodrooster', [
    'uses' => '\Brood\Http\Controllers\BroodroosterController@getBroodrooster',
    'as' => 'user.broodrooster',
]);
Route::post('/broodrooster', [
    'uses' => '\Brood\Http\Controllers\BroodroosterController@postSetCycleDays',
    'as' => 'user.broodrooster.cyclist',
    'middleware' => ['auth'],
]);
Route::post('/broodrooster/ruilen', [
    'uses' => '\Brood\Http\Controllers\BroodroosterController@postSwapDates',
    'as' => 'user.broodrooster.swap',
    'middleware' => ['auth'],
]);
Route::post('/broodrooster/opgeven', [
    'uses' => '\Brood\Http\Controllers\BroodroosterController@postFillDates',
    'as' => 'user.broodrooster.fill',
    'middleware' => ['auth'],
]);


// Reset routes
Route::get('/password/email', [
    'uses' => '\Brood\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm',
    'as' => 'auth.password.email',
]);
Route::post('/password/email', [
    'uses' => '\Brood\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail',
]);
Route::get('/password/reset/{token?}', [
    'uses' => '\Brood\Http\Controllers\Auth\ResetPasswordController@showResetForm',
    'as' => 'auth.password.reset',
]);
Route::post('/password/reset/{token?}', [
    'uses' => '\Brood\Http\Controllers\Auth\ResetPasswordController@reset',
    'as' => 'auth.password.reset',
]);
Route::get('/aanpassen', [
    'uses' => '\Brood\Http\Controllers\ResetController@getReset',
    'as' => 'user.profile.index',
    'middleware' => ['auth'],
]);
Route::post('/aanpassen/naam', [
    'uses' => '\Brood\Http\Controllers\ResetController@postResetUsername',
    'as' => 'user.profile.username',
    'middleware' => ['auth'],
]);
Route::post('/aanpassen/email', [
    'uses' => '\Brood\Http\Controllers\ResetController@postResetEmail',
    'as' => 'user.profile.email',
    'middleware' => ['auth'],
]);
Route::post('/aanpassen/wachtwoord', [
    'uses' => '\Brood\Http\Controllers\ResetController@postResetPassword',
    'as' => 'user.profile.wachtwoord',
    'middleware' => ['auth'],
]);


// Administrator routes
Route::get('admin', [
    'uses' => '\Brood\Http\Controllers\AdminController@getAdmin',
    'as' => 'admin.index',
    'middleware' => ['auth'],
]);
Route::get('admin/broodrooster', [
    'uses' => '\Brood\Http\Controllers\AdminController@getAdminBroodrooster',
    'as' => 'admin.broodrooster.index',
    'middleware' => ['auth'],
]);
Route::post('admin/broodrooster', [
    'uses' => '\Brood\Http\Controllers\AdminController@postAdminBroodrooster',
    'as' => 'admin.broodrooster.index',
    'middleware' => ['auth'],
]);
Route::post('admin/broodrooster/remove', [
    'uses' => '\Brood\Http\Controllers\AdminController@postRemoveFromBroodrooster',
    'as' => 'admin.broodrooster.remove',
    'middleware' => ['auth'],
]);
Route::post('admin/mededeling', [
    'uses' => '\Brood\Http\Controllers\MessageController@postNewMessage',
    'as' => 'admin.message',
    'middleware' => ['auth'],
]);
Route::get('admin/mededeling/verwijderen/{message}', [
    'uses' => '\Brood\Http\Controllers\MessageController@removeMessage',
    'as' => 'admin.message.remove',
    'middleware' => ['auth'],
]);

// Mail routes
Route::get('admin/verstuurbestelling', [
    'uses' => '\Brood\Http\Controllers\MailController@mailOrder',
    'as' => 'admin.email.order',
    'middleware' => ['auth'],
]);
Route::get('/admin/rekeningen/versturen', [
    'uses' => '\Brood\Http\Controllers\MailController@mailUserBills',
    'as' => 'admin.email.userbills',
    'middleware' => ['auth'],
]);


// Breadlist routes
Route::get('admin/broodlijst', [
    'uses' => '\Brood\Http\Controllers\BreadlistController@getBreadUpdate',
    'as' => 'admin.bread.updatebreadlist',
    'middleware' => ['auth'],
]);
Route::post('admin/broodlijst', [
    'uses' => '\Brood\Http\Controllers\BreadlistController@postBreadUpdate',
    'middleware' => ['auth'],
]);

// Roles routes
Route::get('/admin/rechten', [
    'uses' => '\Brood\Http\Controllers\RoleController@getUserChangeRights',
    'as' => 'admin.user.changerights',
    'middleware' => ['auth'],
]);
Route::post('/admin/rechten/beheerdersrechten', [
    'uses' => '\Brood\Http\Controllers\RoleController@postAdminRights',
    'as' => 'admin.user.adminrights',
    'middleware' => ['auth'],
]);
Route::post('/admin/rechten/gebruikersrechten', [
    'uses' => '\Brood\Http\Controllers\RoleController@postUserRights',
    'as' => 'admin.user.userrights',
    'middleware' => ['auth'],
]);

// Search routes
Route::get('/admin/bestellingen/zoeken', [
    'uses' => '\Brood\Http\Controllers\SearchController@getResults',
    'as' => 'admin.user.search',
    'middleware' => ['auth'],
]);