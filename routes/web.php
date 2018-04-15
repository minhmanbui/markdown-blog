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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/new', 'HomeController@viewCreatePost')->middleware('auth')->name('new-post');
Route::post('/new', 'HomeController@actionCreatePost')->middleware('auth');

Route::get('/new_success', 'HomeController@viewCreatePostSuccess')->middleware('auth')->name('post.create.success');

Route::get('/{post_id}', 'HomeController@viewDetailPost')->name('post-detail')->where('post_id', '[0-9]+');
// Route::get('/{post_id}/edit', 'HomeController@viewUpdatePost')->middleware('auth');
// Route::post('/{post_id}/edit', 'HomeController@actionUpdatePost')->middleware('auth');

Route::prefix('/admin')->middleware(['auth'])->group(function () {

    Route::get('/', 'AdminController@index')->middleware('auth')->name('management-post');
    Route::post('/{post_id}/approve', 'AdminController@approve')->name('approve-post');
    Route::post('/{post_id}/remove', 'AdminController@remove')->name('remove-post');

});
