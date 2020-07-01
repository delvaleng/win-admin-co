<?php

Route::get('/',         'Auth\LoginController@showLoginForm');
Route::post('login',    'Auth\LoginController@login' )->name('login');
Route::post('logout',   'Auth\LoginController@logout')->name('logout');


//GENERALES
Route::match(['get', 'post'], '/country/{id}',     'Admin\CountryController@get2'   )->name('country.get');
Route::match(['get', 'post'], '/departament/{id}', 'Admin\DepartamentController@get')->name('departaments.get');
Route::match(['get', 'post'], '/city/{id}',        'Admin\CityController@get'       )->name('cities.get');


Route::group(['middleware' => 'auth'], function(){

  Route::get('/home',     'Auth\LoginController@home'  )->name('home');

  //  ARREGLADO
  Route::resource('menus',                             'Admin\MenuController' );
  Route::match(['get', 'post'], '/getMains',           'Admin\MenuController@getMains')->name('menus.get');
  Route::resource('roles',                             'Admin\RolesController');
  Route::match(['get', 'post'], '/updateStatusTpRols', 'Admin\RolesController@updateStatus'  );
  Route::match(['get', 'post'], '/getTpRols',          'Admin\RolesController@getTpRols'     );
  Route::resource('rol-menus',                         'Admin\RolMenuController'             );
  Route::match(['get', 'post'], '/getRolMain',         'Admin\RolMenuController@getRolMain'  )->name('rol-menus.get');
  Route::match(['get', 'post'], '/updateStatusRolMenu','Admin\RolMenuController@updateStatus');
  Route::resource('rol-usuarios',                      'Admin\RolUsersController'            );
  Route::match(['get', 'post'], '/getRolUsers',        'Admin\RolUsersController@getRolUsers');

  //USUARIO
  Route::get ('/usuarios',         			                   'User\UserController@index'       )->name('user.index');
  Route::match(['get', 'post'],'/getUsers',                'User\UserController@getUsers'    );
  Route::match(['get', 'post'],'/validUserDni',            'User\UserController@validUserDni');
  Route::get ('/usuarios/new',         	   	               'User\UserController@create'      )->name('user.create');
  Route::post('/usernew',         	                       'User\UserController@store'       );
  Route::match(['get', 'post'],'/validUser',               'User\UserController@validUser'   );
  Route::match(['get', 'post'],'/userDetails',     			   'User\UserController@userDetails'     );
  Route::match(['get', 'post'],'/user/rolDetails',         'User\UserController@rolDetails'      );
  Route::match(['get', 'post'],'/user/rolDetailsSelect',   'User\UserController@rolDetailsSelect');
  Route::match(['get', 'post'],'/user/updateRolUser',      'User\UserController@updateRolUser'   );
  Route::match(['get', 'post'],'/user/updatePassword',     'User\UserController@updatePassword'  );
  Route::match(['get', 'post'],'/user/updateStatus',       'User\UserController@updateStatus'    );
  Route::match(['get', 'post'],'/user/PermisosDetails',    'User\UserController@PermisosDetails' );
  Route::match(['get', 'post'],'/user/updatePermisoUser',  'User\UserController@updatePermisoUser');
  Route::get ('/mi-perfil',                                'User\UserController@miperfil'         )->name('user.mi-perfil');
  Route::get ('/cambiar-contrasena',                       'User\UserController@changePassword')->name('user.cambiarContrasena');
	Route::POST('/saveContrasena',                           'User\UserController@savePassword'  )->name('user.saveContrasena');

  //USUARIO

  //MARCACIONES
  Route::resource('horarios',                       'Marcacion\HorarioController');
  Route::post('/marcando',                          'Marcacion\MarcacionController@store')->name('marcaciones.store');
  Route::get('/marcaciones',                        'Marcacion\MarcacionController@index')->name('marcaciones.index');
  Route::resource('marcaciones-conf-tipo',          'Marcacion\TpMarcacionController');
  Route::resource('marcaciones-conf-horarios',      'Marcacion\HorarioUserController');
  Route::resource('marcaciones-autorizaciones',     'Marcacion\AutorizacionEmpleadoController'  );
  Route::match(['get', 'post'],'/getAutorizaciones','Marcacion\AutorizacionEmpleadoController@getAutorizaciones')->name('marcaciones-autorizaciones.search');
  Route::get('/marcaciones-reporte-general',        'Marcacion\MarcacionController@report'      )->name('marcacions.report');
  Route::post('/reportSearch',                      'Marcacion\MarcacionController@reportSearch')->name('marcacions.reportSearch');
  Route::post('/searchAutorizacion',                'Marcacion\AutorizacionEmpleadoController@searchAutorizacion');

  Route::get('/marcacionsMaps/{long}/{lat}',        'Marcacion\MarcacionController@marcacionsMaps')->name('marcacions.maps');
  Route::post('/getMarcacions',                     'Marcacion\MarcacionController@getMarcacions')->name('marcacions.getMarcacions');
  Route::post('/sendAutorizacion',                  'Marcacion\AutorizacionEmpleadoController@sendAutorizacion');
  //MARCACIONES


  //DIRECCIONES
  //TIPO PAIS
  Route::resource('pais',                         'Admin\CountryController');
  Route::match(['get', 'post'],'/getCountries',   'Admin\CountryController@get');
  Route::match(['get', 'post'],'/statusCountries','Admin\CountryController@status');
  //TIPO DEPARTAMENTO
  Route::resource('departamentos',                'Admin\StateController');
  Route::match(['get', 'post'],'/getState',       'Admin\StateController@get');
  Route::match(['get', 'post'],'/statusEstados',  'Admin\StateController@status');
  //TIPO CITY
  Route::resource('ciudades',                     'Admin\CityController');
  Route::match(['get', 'post'],'/getCities',      'Admin\CityController@getCities');
  Route::match(['get', 'post'],'/statusCities',   'Admin\CityController@status');
  //  ARREGLADO
  Route::resource('tp-documentos-identidad',      'Admin\TpDocumentIdentController');
  Route::resource('auditoria',                    'Auditoria\AuditoriaController');
  Route::match(['get', 'post'],'/getAuditoria',   'Auditoria\AuditoriaController@get');


});//FIN DE SESSION
