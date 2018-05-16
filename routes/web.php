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

Route::group(['prefix' => 'projects'], function() {
    
    Route::get('create', 'ProjectController@create')->name('createProject');
    Route::post('/', 'ProjectController@store')->name('storeProject');
    
    Route::get('{project}', 'ProjectController@show')->name('showProject');
    Route::put('{project}', 'ProjectController@update')->name('updateProject');
    Route::delete('{project}', 'ProjectController@destroy')->name('deleteProject');
    
    Route::get('switch/{project}', 'SwitchProjectsController@update')->name('switchProject');
});
