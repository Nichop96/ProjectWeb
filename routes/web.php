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

// da cambiare con la nostra home(?)
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/about', function () {
    return view('about');
})->name('about');

// da togliere(?
Route::post('/admin/users/search', 'Admin\UserController@merda');
Route::post('/admin/groups/search', 'Admin\GroupController@merda');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home'); ---> funziona

Route::namespace('Admin')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    Route::resource('/users','UserController',['except' => ['create','store']]);
    Route::resource('/modules','ModuleController');
    Route::resource('/questions','QuestionController');
    Route::resource('/groups', 'GroupController');
    Route::resource('/surveys', 'SurveyController');
    Route::get('/surveys/{id}/create', 'SurveyController@create');
    Route::get('/index', function () {
        return view('admin.index');
        })->name('index');
    Route::get('/impersonate/user/{id}','ImpersonateController@index')->name('impersonate');
    Route::get('/surveys/{id}/view', 'SurveyController@view')->name('surveys.view');
});

Route::get('/admin/impersonate/destroy','Admin\ImpersonateController@destroy')->name('admin.impersonate.destroy');

Route::namespace('User')->prefix('user')->middleware(['auth','auth.user'])->name('user.')->group(function(){
    Route::resource('/surveys', 'SurveyController');
    Route::get('/surveys/{id}/create', 'SurveyController@create');
    Route::get('/surveys/{id}/show', 'SurveyController@show');
    Route::resource('/groups', 'GroupController');
    Route::get('/index', function () {
        return view('user.index');
        })->name('index');
});


