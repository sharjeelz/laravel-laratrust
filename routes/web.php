<?php

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
use App\Events\DoctorAdded;

Route::group(['prefix' => 'admin', 'middleware' => ['role:'.env('USER_ROLE'),'permission:'.env('USER_PERMISSION')]],

function() {

    Route::get('users','SystemUserController@index');
    Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('permissions','SystemUserController@Permissionsindex');
    Route::post('permission', 'SystemUserController@storePermission');
    Route::get('permission/create','SystemUserController@createPermission');
    Route::get('roles', 'SystemUserController@Rolesindex');
    Route::get('role/create','SystemUserController@createRole');
    Route::post('role','SystemUserController@storeRole');
    Route::post('destroy/user', 'SystemUserController@destroyUser');
    Route::post('destroy/role', 'SystemUserController@destroyRole');
    Route::post('destroy/permission', 'SystemUserController@destroyPermission');
    Route::post('destroy/users', 'SystemUserController@destroyUsers');
    Route::post('restore/users', 'SystemUserController@restoreUsers');
    Route::post('restore/user', 'SystemUserController@restoreUser');
    Route::post('reset/user/password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('role/users/{id}','SystemUserController@getUsersByRole');
    Route::post('assign/role', 'SystemUserController@assignRole');
    Route::post('assign/permission', 'SystemUserController@assignPermission');
    Route::post('export/users', 'SystemUserController@exportUsers');
    Route::get('export/logins/{id}', 'SystemUserController@exportLogins');
    Route::get('user/profile/edit/{user_id}','SystemUserController@userProfile');
    Route::post('user/send/mail', 'SystemUserController@sendEmail');
    Route::post('user/profile/update/{id}', 'SystemUserController@userProfileUpdate')->name('admin.user.update');
    Route::post('user/send/mail/{id}', 'SystemUserController@sendEmail')->name('admin.user.send.email');

});


//public routes
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/','HomeController@index');



// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
