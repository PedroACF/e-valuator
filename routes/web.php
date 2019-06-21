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


Route::group(['middleware' => ['auth']], function(){

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/categories', 'CategoryController@index');


    Route::resource('courses','CourseController');
    Route::resource('user_course','User_courseController');

    Route::get('/home', 'HomeController@index')->name('home');
});

Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories.detail');
Route::post('/categories/create', 'CategoryController@store')->name('categories.store');
Route::get('questions/{category_id}/create', 'QuestionController@create')->name('questions.create');
Route::post('questions/{category_id}/create', 'QuestionController@store')->name('questions.store');

