<?php
require app_path().'/constants.php';

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
Route::get('/', 'AdminController@login');
Route::get('/admin/login', 'AdminController@login');
Route::post('/admin', 'AdminController@login');
Route::get('/admin/logout','AdminController@logout');

/* START Checking Session Admin Id */
Route::group(['middleware' => 'SessionsExpire'], function() {
    /* START Admin And Dashbaord Route */
        Route::get('/dashboard','DashboardController@index')->name('dashboard');
        Route::get('/admin','AdminController@index');
        Route::get('/admin/index','AdminController@index');
        Route::get('/admin/records','AdminController@records');
        Route::post('/admin/update_status','AdminController@update_status');
        Route::get('/admin/delete/{id}','AdminController@destroy');
        Route::put('/admin/update/{id}','AdminController@update');
        Route::post('/admin/create','AdminController@create');
        Route::post('/admin/edit','AdminController@edit');
        Route::post('/admin/edit','AdminController@edit');
    /* END Admin And Dashbaord Route */
        
    /* START Applications Route */
        Route::get('/application','ApplicationController@index')->name('application.index');
        Route::get('/application/records','ApplicationController@records');
        Route::post('/application', 'ApplicationController@store')->name('application.store');
        Route::post('/application/package_name', 'ApplicationController@package_name')->name('application.package_name');
    /* END Applications Route */
});      
        
/* END Checking Session Admin Id */