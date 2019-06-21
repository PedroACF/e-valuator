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

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function(){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/categories', 'CategoryController@index');


    Route::resource('courses','CourseController');
    Route::resource('user_course','User_courseController');
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});