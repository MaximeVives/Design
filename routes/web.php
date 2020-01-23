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
//     return view('accueil');
// });

Route::get('/', 'importDataController@importProduit');
Route::get('/panier', 'importDataController@cartData')->name('panier');
Route::get('/send-data','HomeController@sendData' )->name('send-data');

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout');