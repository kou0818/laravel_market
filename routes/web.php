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

Route::get('/', 'ItemController@index')->name('items.index');

Auth::routes();

// プロフィール詳細
Route::get('users/{user}', 'UserController@show')->name('users.show');

// プロフィール編集
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile', 'ProfileController@update')->name('profile.update');

// プロフィール画像編集
Route::get('/profile/edit_image', 'ProfileController@editImage')->name('profile.edit_image');
Route::patch('/profile/edit_image', 'ProfileController@updateImage')->name('profile.update_image');

// 出品商品一覧
Route::get('/users/{user}/exhibitions', 'UserController@exhibitions')->name('users.exhibitions');

// 新規出品
// Route::get('/items/create', 'ItemController@create')->name('items.create');
// Route::post('/items', 'ItemController@store');
Route::resource('items', 'ItemController');

// 商品情報編集
Route::get('/items/{item}/edit', 'ItemController@edit')->name('items.edit');
Route::patch('/items/{item}/edit', 'ItemController@edit')->name('items.edit');


//商品画像変更
Route::get('/items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');
Route::patch('/items/{item}/edit_image', 'ItemController@updateImage')->name('items.update_image');

// 商品詳細
Route::get('/items/{item}', 'ItemController@show')->name('items.show');

// 購入確認
Route::post('/items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');

// 購入確認
Route::post('/items/{item}/finish', 'ItemController@finish')->name('items.finish');

// お気に入り一覧
Route::resource('likes', 'LikeController');
Route::patch('/items/{item}/toggle_like', 'ItemController@toggleLike')->name('items.toggle_like');

