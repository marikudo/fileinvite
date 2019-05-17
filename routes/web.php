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

Route::get('/', ['uses' => 'ItemController@index'])->name('item');
Route::get('/get-items', ['uses' => 'ItemController@data'])->name('item.items');
Route::post('/add-item', ['uses' => 'ItemController@save'])->name('item.add');
Route::put('/update-status-item', ['uses' => 'ItemController@save'])->name('item.add');
Route::delete('/delete-item', ['uses' => 'ItemController@delete'])->name('item.delete');

Route::get('/tool', ['uses' => 'GsuiteController@index'])->name('tool');
Route::post('/tool/upload', ['uses' => 'GsuiteController@upload'])->name('tool.upload');