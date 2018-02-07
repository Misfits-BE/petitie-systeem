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
