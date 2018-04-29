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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//-------------------------------------------------------------------------- PROGRAMAS --------------------------------------------------------------------------
Route::get('catProgramas', 'CatProgramaController@catProgramasDataTable');
Route::get('/programas', 'CatProgramaController@index')->name('programa.index');
Route::get('/programa/create', 'CatProgramaController@create')->name('programa.create');
Route::post('/programa/store', 'CatProgramaController@store')->name('programa.store');
Route::get('/programa/{sucursal}/edit', 'CatProgramaController@edit')->name('programa.edit');
Route::put('/programa/{sucursal}', 'CatProgramaController@update')->name('programa.update');
Route::get('/programa/{sucursal}', 'CatProgramaController@show')->name('programa.show');
Route::get('/programa/{sucursal}/delete', 'CatProgramaController@destroy')->name('programa.destroy');
