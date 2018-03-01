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
Route::get('helpdesk', 'Frontend\helpdeskController@index')->name('helpdesk.index');
Route::get('helpdesk/nieuw', 'Frontend\HelpdeskController@create')->name('helpdesk.create');
Route::get('helpdesk/{ticket}', 'Frontend\HelpdeskController@show')->name('helpdesk.show');
Route::post('helpdesk/store', 'Frontend\HelpdeskController@store')->name('helpdesk.store');

Route::get('helpdesk/status/{slug}/{status}', 'Admin\Helpdesk\TicketController@close')->name('admin.helpdesk.tickets.status');

// Comment routes
Route::post('comment/{slug}/store', 'Shared\CommentController@store')->name('comment.store');
Route::get('comment/delete/{comment}', 'Shared\CommentController@destroy')->name('comment.delete');

// Admin helpdesk routes
Route::get('admin/helpdesk', 'Admin\Helpdesk\IndexController@index')->name('admin.helpdesk.index');

// Admin helpdesk routes (categories)
Route::get('admin/helpdesk/categories', 'Admin\Helpdesk\CategoryController@index')->name('admin.helpdesk.categories.index');
Route::get('admin/helpdesk/categories/edit/{id}', 'Admin\Helpdesk\CategoryController@edit')->name('admin.helpdesk.categories.edit');
Route::get('admin/helpdesk/categories/create', 'Admin\Helpdesk\CategoryController@create')->name('admin.helpdesk.categories.create');
Route::get('admin/helpdesk/categories/delete/{id}', 'Admin\Helpdesk\CategoryController@destroy')->name('admin.helpdesk.categories.delete');
Route::post('admin/helpdesk/categories/store', 'Admin\Helpdesk\CategoryController@store')->name('admin.helpdesk.categories.store');
Route::patch('admin/helpdesk/categories/update/{id}', 'Admin\Helpdesk\CategoryController@update')->name('admin.helpdesk.categories.update');

// Admin helpdesk routes (Tickets)
Route::get('admin/helpdesk/tickets', 'Admin\Helpdesk\TicketController@index')->name('admin.helpdesk.tickets');
Route::get('admin/helpdesk/ticket/show/{slug}', 'Admin\Helpdesk\TicketController@show')->name('admin.helpdesk.tickets.show');
Route::get('admin/helpdesk/tickets/assign/{slug}', 'Admin\Helpdesk\TicketController@assign')->name('admin.helpdesk.tickets.assign');
Route::get('admin/tickets/assigned', 'Admin\Helpdesk\TicketController@userAssigned')->name('admin.helpdesk.tickets.assigned');

// User ban routes 
Route::get('admin/users/ban/{id}', 'Admin\Users\BanController@create')->name('admin.users.ban');
Route::get('/admin/users/unban/{id}', 'Admin\Users\BanController@destroy')->name('admin.users.ban.revoke');
Route::post('admin/users/ban/{id}', 'Admin\Users\BanController@store')->name('admin.users.ban.create');

// User management console
Route::get('admin/users', 'Admin\Users\IndexController@index')->name('admin.users.index');
Route::get('admin/users/create', 'Admin\Users\IndexController@create')->name('admin.users.create');
Route::get('admin/users/delete/{id}', 'Admin\Users\IndexController@destroy')->name('admin.users.delete');