<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', 'DataController@test');
Route::get('/', 'DataController@index');
Route::get('/videos', 'DataController@videos');
Route::get('/synopsis', 'DataController@synopsis');
Route::get('/en', 'DataController@english_landing');
Route::get('/api/shows', 'DataController@showsApi');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<<<<<<< HEAD
Route::group(['middleware' => ['auth']], function () {
    Route::get('/test-nl/api/shows', 'PagesController@showsApi');
    Route::post('/upload', 'HomeController@upload');
    Route::get('/test-en', 'PagesController@landing_en');
    Route::get('/test-nl', 'PagesController@landing_nl');
    Route::post('/update-info', 'HomeController@update_info')->name('update_info');

    Route::get('/userlist', 'AdminController@userlist');
    Route::post('/userlist/create', 'AdminController@create_user')->name('create.user');
    Route::get('/userlist/delete/{id}', 'AdminController@delete_user');
    Route::get('/userlist/edit/{id}', 'AdminController@edit_user');
    Route::post('/userlist/edit/{id}', 'AdminController@edit_user_post');

    Route::get('/movielist', 'AdminController@movielist');
    Route::get('/movielist/delete/{id}', 'AdminController@movie_delete');
=======
Route::group(['middleware' => ['auth']], function()
{
  Route::get('/test-nl/api/shows', 'PagesController@showsApi');
  Route::post('/upload', 'HomeController@upload');
  Route::get('/test-en', 'PagesController@landing_en');
  Route::get('/test-nl', 'PagesController@landing_nl');
  Route::post('/update-info', 'HomeController@update_info')->name('update_info');

  Route::get('/userlist', 'AdminController@userlist');
  Route::post('/userlist/create', 'AdminController@create_user')->name('create.user');
  Route::get('/userlist/delete/{id}', 'AdminController@delete_user');
  Route::get('/userlist/edit/{id}', 'AdminController@edit_user');
  Route::post('/userlist/edit/{id}', 'AdminController@edit_user_post');

  Route::get('/movielist', 'AdminController@movielist');
  Route::get('/movielist/edit/{id}', 'AdminController@movie_edit');
  Route::post('/movielist/edit/{id}', 'AdminController@movie_edit_post');
  Route::get('/movielist/delete/{id}', 'AdminController@movie_delete');
  
>>>>>>> 7064c41a38937f9ea706657974b5e958e278bd33
});
