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
//\URL::forceScheme('https');


Route::get('/', 'Dashboard\HomeController@index')->name('index');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.form');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.change');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::get('/password/reset/{token} ', 'Auth\ResetPasswordController@showResetForm');


Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'dashboard::'], function () {


  Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('index');

    Route::resource('/users', 'UserController', ['except' => ['show']]);
    Route::get('/users/{user}/access', 'UserController@toggleAccess')->name('users.toggleAccess');
    Route::get('/users/{id}/destroy', 'UserController@destroy')->name('users.destroy');
    Route::get('/users/export', 'UserController@export')->name('users.export');

    Route::resource('/roles', 'RoleController', ['except' => ['show']]);
    Route::get('/roles/{id}/destroy', 'RoleController@destroy')->name('roles.destroy');
    Route::resource('/permissions', 'PermissionController', ['except' => ['show']]);
    Route::get('/permissions/{id}/destroy', 'PermissionController@destroy')->name('permissions.destroy');
    Route::get('/common/slug/{name}', 'CommonController@slug')->name('common.slug');

    Route::get('/pdfs', 'PdfController@index')->name('pdfs.index');
    Route::post('/pdfs/generate', 'PdfController@export_document_generate')->name('pdfs.export_document_generate');
    Route::post('/pdfs/url', 'PdfController@export_document_url')->name('pdfs.export_document_url');
    Route::get('/pdfs/view', 'PdfController@export_by_view')->name('pdfs.export_by_view');

    Route::get('/graphics/vistahumedadambiente', 'GraphicsController@consultagraphics_view')->name('graphics.consultagraphics_view');
    Route::post('/graphics/vistahumedadambiente', 'GraphicsController@respuestagraphics_view')->name('graphics.respuestagraphics_view');

    Route::get('/graphics/vistahumedadsuelo', 'GraphicshsController@consultagraphicshumedads_view')->name('graphics.consultagraphicshumedads_view');
    Route::post('/graphics/vistahumedadsuelo', 'GraphicshsController@respuestagraphicshumedads_view')->name('graphics.respuestagraphicshumedads_view');
    
    Route::get('/graphics/vistatemperatura', 'GraphicsteController@consultagraphicstemperatura_view')->name('graphics.consultagraphicstemperatura_view');
    Route::post('/graphics/vistatemperatura', 'GraphicsteController@respuestagraphicstemperatura_view')->name('graphics.respuestagraphicstemperatura_view');
    
    Route::get('/graphics/vistalitros', 'GraphicsliController@consultagraphicslitros_view')->name('graphics.consultagraphicslitros_view');
    Route::post('/graphics/vistalitros', 'GraphicsliController@respuestagraphicslitros_view')->name('graphics.respuestagraphicslitros_view');
    
    Route::get('/graphics/tiemporealha', 'GraphicsrealhaController@consultagraphicsrealha_view')->name('graphics.consultagraphicsrealha_view');
    Route::get('/graphics/tiemporealhs', 'GraphicsrealhsController@consultagraphicsrealhs_view')->name('graphics.consultagraphicsrealhs_view');
    Route::get('/graphics/tiemporealte', 'GraphicsrealteController@consultagraphicsrealte_view')->name('graphics.consultagraphicsrealte_view');

    Route::get('/graphics/encenderapagar', 'GraphicsrealonoffController@consultagraphicsrealonoff_view')->name('graphics.consultagraphicsrealonoff_view');
    
    Route::get('/maps/maps', 'MapsController@maps_view')->name('maps.maps_view');

  });



});


/*
|--------------------------------------------------------------------------
| Ruta especifica para visualizar paginas estáticas.
|--------------------------------------------------------------------------
|
| Esta ruta permite visualizar paginas estáticas siempre que se las pida
| a través de la extensión "html".
|
*/
