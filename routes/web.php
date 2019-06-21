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

    Route::prefix('categories')->group(function(){
        Route::get('/', 'CategoryController@index')->name('categories.index');
        Route::get('create', 'CategoryController@create')->name('categories.create');
        Route::post('create', 'CategoryController@store')->name('categories.store');
        Route::get('{id}', 'CategoryController@detail')->name('categories.detail');
        Route::get('{id}/edit', 'CategoryController@edit')->name('categories.edit');
        Route::post('{id}/edit', 'CategoryController@update')->name('categories.update');
    });

    Route::prefix('questions/{category_id}')->group(function(){
        Route::get('/', 'QuestionController@index')->name('questions.index');
        Route::get('create', 'QuestionController@create')->name('questions.create');
        Route::post('create', 'QuestionController@store')->name('questions.store');
        Route::get('{id}/edit', 'QuestionController@edit')->name('questions.edit');
        Route::post('{id}/edit', 'QuestionController@update')->name('questions.update');
    });






    Route::resource('courses','CourseController');
    Route::resource('user_course','User_courseController');

    Route::get('/home', 'HomeController@index')->name('home');
});
