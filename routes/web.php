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


Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home','CatProgramaController@index')->name('home');

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
Route::get('catCompontes/{idPrograma}', 'CatComponenteController@catCompontesDataTable')->name('catCompontes.dataTable');
Route::get('/componentes', 'CatComponenteController@index')->name('componente.index');
Route::get('/programa/{idPrograma}/componentes', 'CatComponenteController@index')->name('programa.componentes');
Route::get('/componente/create', 'CatComponenteController@create')->name('componente.create');
Route::get('/programa/{idPrograma}/componente/create', 'CatComponenteController@createComponente')->name('programa.create.componente');
Route::post('/componente/store', 'CatComponenteController@store')->name('componente.store');
Route::get('/componente/{id}/edit', 'CatComponenteController@edit')->name('componente.edit');
Route::put('/componente/{id}', 'CatComponenteController@update')->name('componente.update');
Route::get('/componente/{id}', 'CatComponenteController@show')->name('componente.show');
Route::get('/componente/{id}/delete', 'CatComponenteController@destroy')->name('componente.destroy');

//-------------------------------------------------------------------------- Organizaciones --------------------------------------------------------------------------
Route::get('catOrganizaciones/{idComponente}', 'CatOrganizacionController@catOrganizacionesDataTable')->name('catOrganizaciones');
Route::get('/organizaciones', 'CatOrganizacionController@index')->name('organizacion.index');
Route::get('/programa/{idPrograma}/componente/{idComponente}/organizaciones', 'CatOrganizacionController@index')->name('componente.index.programa');
Route::get('/programa/{idPrograma}/componente/{idComponente}/organizacion/create', 'CatOrganizacionController@create')->name('organizacion.create');
Route::post('/organizacion/store', 'CatOrganizacionController@store')->name('organizacion.store');
Route::get('/programa/{idPrograma}/componente/{idComponente}/organizacion/{idOrganizacion}/edit', 'CatOrganizacionController@edit')->name('organizacion.edit');
Route::put('/organizacion/{id}', 'CatOrganizacionController@update')->name('organizacion.update');
Route::get('/organizacion/{id}', 'CatOrganizacionController@show')->name('organizacion.show');
Route::get('/organizacion/{id}/delete', 'CatOrganizacionController@destroy')->name('organizacion.destroy');


//-------------------------------------------------------------------------- Archivos --------------------------------------------------------------------------
Route::post('documento', 'OrganizacionController@guardarArchivo')->name('save.file');
Route::post('documento/editar/', 'OrganizacionController@editarArchivo')->name('edit.file');
Route::get('documento/{id}', 'OrganizacionController@getArchivo')->name('file.get');
Route::post('documento/{id}/delete', 'OrganizacionController@docDestroy')->name('doc.destroy');
Route::get('documentos/{idOrganizacion}', 'OrganizacionController@zipAll')->name('zip');

//------------------------------------------------------------------ AUDITORIAS ---------------------------------------------------------------------------------
Route::get('/auditoria', 'AuditoriaController@index')->name('auditoria.index');
Route::get('/auditoria/{idComponente}', 'AuditoriaController@carpetas')->name('carpetas.componte');
Route::get('/auditoria/cat-compontes/lista', 'AuditoriaController@componetesDatatable')->name('componetes.auditoria.dataTable');
Route::get('/auditoria/componente/{idCatComponente}', 'AuditoriaController@carpetas')->name('auditoria.componente');
Route::post('/auditoria/nueva-carpeta/store', 'AuditoriaController@createCarpeta')->name('nueva.carpeta');
