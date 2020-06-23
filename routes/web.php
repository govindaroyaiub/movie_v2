<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', 'DataController@test');
Route::get('/', 'DataController@index');
Route::get('/en', 'DataController@english_landing');
Route::get('/api/shows', 'DataController@showsApi');
Route::post('/get_google_sheet', 'DataController@get_google_sheet')->name('google_sheet.check');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

    Route::get('/theaterlist', 'AdminController@theaterlist');
    Route::post('/theaterlist/create', 'AdminController@theater_create');
    Route::get('/theaterlist/edit/{id}', 'AdminController@theater_edit');
    Route::post('/theaterlist/edit/{id}', 'AdminController@theater_edit_post');
    Route::get('/theaterlist/delete/{id}', 'AdminController@theater_delete');

    Route::get('/movielist', 'AdminController@movielist');
    Route::post('/movielist/create', 'AdminController@movie_create');
    Route::get('/movielist/edit/{id}', 'AdminController@movie_edit');
    Route::post('/movielist/edit/tmd/{id}', 'AdminController@tmd_edit');
    Route::post('/movielist/edit/en/{id}', 'AdminController@en_edit');
    Route::post('/movielist/edit/nl/{id}', 'AdminController@nl_edit');
    Route::post('/movielist/edit/{id}', 'AdminController@movie_edit_post');
    Route::get('/movielist/delete/{id}', 'AdminController@movie_delete');

    Route::get('/partnerlist/distributors', 'AdminController@d_list');
    Route::post('/partnerlist/distributor/create', 'AdminController@d_create');
    Route::get('/partnerlist/distributor/edit/{id}', 'AdminController@d_edit');
    Route::post('/partnerlist/distributor/edit/{id}', 'AdminController@d_edit_post');
    Route::get('/partnerlist/distributor/delete/{id}', 'AdminController@d_delete');

    Route::get('/partnerlist/media_partners', 'AdminController@mp_list');
    Route::post('/partnerlist/media_partner/create', 'AdminController@mp_create');
    Route::get('/partnerlist/media_partner/edit/{id}', 'AdminController@mp_edit');
    Route::post('/partnerlist/media_partner/edit/{id}', 'AdminController@mp_edit_post');
    Route::get('/partnerlist/media_partner/delete/{id}', 'AdminController@mp_delete');
});
