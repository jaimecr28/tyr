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

use Illuminate\Http\Request;

Route::get('/','MeasurementController@status')->name('status');

Route::resource('/empresas','EnterpriseController');
Route::resource('/usuarios','UserController');
Route::resource('/setores','SectorController');
Route::resource('/sensores','SensorController');


Route::get('/meuusuario', 'UserController@index')->name('meuusuario');
Route::get('/acompanhar', 'MeasurementController@liveIndex')->name('live');
Route::post('/meuusuario', 'UserController@update')->name('user.update');

Route::post('/plotsetor', 'MeasurementController@plotSector')->name('plotsetor');

route::get('/relatorios', 'ReportController@index')->name('relatorios');

route::get('/detalhado', 'ReportController@detalhado');

Auth::routes(['verify']);


Route::post('/novamedida', 'ApiMeasurements@insert');



// Route::get('/home', 'HomeController@index');


Route::group(['middleware'=>'auth'], function () {
	Route::get('permissions-all-users',['middleware'=>'check-permission:user|admin|superadmin','uses'=>'HomeController@allUsers']);
	Route::get('permissions-admin-superadmin',['middleware'=>'check-permission:admin|superadmin','uses'=>'HomeController@adminSuperadmin']);
	Route::get('permissions-superadmin',['middleware'=>'check-permission:superadmin','uses'=>'HomeController@superadmin']);
});
