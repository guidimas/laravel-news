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
    return redirect(route('news'));
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', function() {
    return redirect(route('news'));
});

Route::post('/new', function () {
    return view('news.new');
})->name('news.new');

// News
Route::prefix('news')->group(function() {

    Route::get('/', 'NewsController@index')->name('news');
    Route::get('create', 'NewsController@create')->name('news.create');
    Route::post('store', 'NewsController@store')->name('news.store');
    Route::get('{id}/details', 'NewsController@details')->name('news.details');
    Route::get('{id}/delete', 'NewsController@delete')->middleware('auth')->name('news.delete');
    
});

// Comments
Route::prefix('comments')->group(function() {
    
    Route::post('store', 'CommentsController@store')->name('comments.store');
    Route::get('attachments/{id}', 'CommentsController@download')->name('comments.attachments.download');
    Route::get('{id}/delete', 'CommentsController@delete')->middleware('auth')->name('comments.delete');

});