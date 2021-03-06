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
Route::get('/programa/{id}/edit', 'CatProgramaController@edit')->name('programa.edit');
Route::put('/programa/{id}', 'CatProgramaController@update')->name('programa.update');
Route::get('/programa/{id}', 'CatProgramaController@show')->name('programa.show');
Route::get('/programa/{id}/delete', 'CatProgramaController@destroy')->name('programa.destroy');

//-------------------------------------------------------------------------- COMPONENTES --------------------------------------------------------------------------
Route::get('catCompontes', 'CatComponenteController@catCompontesDataTable');
Route::get('/componentes', 'CatComponenteController@index')->name('componente.index');
Route::get('/componente/create', 'CatComponenteController@create')->name('componente.create');
Route::post('/componente/store', 'CatComponenteController@store')->name('componente.store');
Route::get('/componente/{id}/edit', 'CatComponenteController@edit')->name('componente.edit');
Route::put('/componente/{id}', 'CatComponenteController@update')->name('componente.update');
Route::get('/componente/{id}', 'CatComponenteController@show')->name('componente.show');
Route::get('/componente/{id}/delete', 'CatComponenteController@destroy')->name('componente.destroy');

//-------------------------------------------------------------------------- Organizaciones --------------------------------------------------------------------------
Route::get('catOrganizaciones', 'CatOrganizacionController@catOrganizacionesDataTable');
Route::get('/organizaciones', 'CatOrganizacionController@index')->name('organizacion.index');
Route::get('/organizacion/create', 'CatOrganizacionController@create')->name('organizacion.create');
Route::post('/organizacion/store', 'CatOrganizacionController@store')->name('organizacion.store');
Route::get('/organizacion/{id}/edit', 'CatOrganizacionController@edit')->name('organizacion.edit');
Route::put('/organizacion/{id}', 'CatOrganizacionController@update')->name('organizacion.update');
Route::get('/organizacion/{id}', 'CatOrganizacionController@show')->name('organizacion.show');
Route::get('/organizacion/{id}/delete', 'CatOrganizacionController@destroy')->name('organizacion.destroy');
