<?php

use Illuminate\Support\Facades\Route;

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

// Routes that store data in the database use the post() method to inidcate that they are using the POST HTTP request method.
// Routes that update data use the put() method to replicate the PUT HTTP method.
// Routes that delete data use the delete() method to replicate the DELETE HTTP request method.
// Routes that are used for editing, updating or deleting data need to pass the ID to the controller in the URL.

// UPDATE PATH TO App\Http\Controllers IN W12

// Route::get('/', 'App\Http\Controllers\ArtistsController@index');

// Route::get('/add', 'App\Http\Controllers\ArtistsController@create');
// Route::post('/store', 'App\Http\Controllers\ArtistsController@store');

// Route::get('/{id}/edit/', 'App\Http\Controllers\ArtistsController@edit');
// Route::put('/{id}/update/', 'App\Http\Controllers\ArtistsController@update');

// Route::delete('/{id}/destroy/', 'App\Http\Controllers\ArtistsController@destroy');

Route::resources([
    '/' => 'App\Http\Controllers\ArtistsController',
    'artists' => 'App\Http\Controllers\ArtistsController',
    'bios' => 'App\Http\Controllers\BioController',
    'artworks' => 'App\Http\Controllers\ArtworkController',
    'galleries' => 'App\Http\Controllers\GalleryController'
]);