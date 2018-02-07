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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Policies 
Route::get('/disclaimer', 'Frontend\PolicyController@disclaimer')->name('policy.disclaimer');

// Account settings 
Route::get('/account-settings', 'Auth\AccountSettingsController@index')->name('account.settings');

// Helpdesk routes
Route::get('helpdesk/nieuw', 'Frontend\HelpdeskController@create')->name('helpdesk.create');
Route::post('helpdesk/store', 'Frontend\HelpdeskController@store')->name('helpdesk.store');

// Admin helpdesk routes
Route::get('admin/helpdesk', 'Admin\Helpdesk\IndexController@index')->name('admin.helpdesk.index');

// Admin helpdesk routes (categories)
Route::get('admin/helpdesk/categories', 'Admin\Helpdesk\CategoryController@index')->name('admin.helpdesk.categories.index');
Route::get('admin/helpdesk/categories/create', 'Admin\Helpdesk\CategoryController@create')->name('admin.helpdesk.categories.create');