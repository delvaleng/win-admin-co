<?php

Route::get('/',         'Auth\LoginController@showLoginForm');
Route::get('/home',     'Auth\LoginController@home')->name('home');
Route::post('login',    'Auth\LoginController@login' )->name('login');
Route::post('logout',   'Auth\LoginController@logout')->name('logout');


//GENERALES
Route::match(['get', 'post'], '/country/{id}',     'General\CountryController@get2'   )->name('country.get');
Route::match(['get', 'post'], '/departament/{id}', 'General\DepartamentController@get')->name('departaments.get');
Route::match(['get', 'post'], '/city/{id}',        'General\CityController@get'       )->name('cities.get');

Route::get('/add/pay',         'app\appController@viewPay');
Route::post('/add/pay/get/driver',         'app\appController@getDriverPeru');
Route::post('/add/pay/get/banks',         'app\appController@getBanck');

Route::group(['middleware' => 'auth'], function(){

Route::resource('autorizacionEmpleados',   'Marcacion\AutorizacionEmpleadoController');
Route::resource('empleados',               'Marcacion\EmpleadoController');
Route::resource('horarios',                'Marcacion\HorarioController');
Route::resource('horarioUsers',            'Marcacion\HorarioUserController');

Route::resource('pais',                    'Marcacion\PaisController');
Route::resource('permisos',                'Marcacion\PermisoController');
Route::resource('passwordoEmpleados',      'Marcacion\PasswordoEmpleadoController');
Route::resource('tpDocumentoIdentidads',   'Marcacion\TpDocumentoIdentidadController');
Route::resource('tpMarcacions',            'Marcacion\TpMarcacionController');


Route::get('/marcacionsMaps/{long}/{lat}', 'Marcacion\MarcacionController@marcacionsMaps')->name('marcacions.maps');
Route::get('/marcacions',                  'Marcacion\MarcacionController@index')->name('marcacions.index');
Route::get('/report',                      'Marcacion\MarcacionController@report')->name('marcacions.report');
Route::post('/getMarcacions',              'Marcacion\MarcacionController@getMarcacions')->name('marcacions.getMarcacions');
Route::post('/reportSearch',               'Marcacion\MarcacionController@reportSearch')->name('marcacions.reportSearch');

Route::post('/searchAutorizacion',         'Marcacion\AutorizacionEmpleadoController@searchAutorizacion');

Route::post('/sendAutorizacion',           'Marcacion\AutorizacionEmpleadoController@sendAutorizacion');

//USUARIO
Route::get ('/users',         			             			   'User\UserController@index'           )->name('user.index');
Route::get ('/user/add',         	               			   'User\UserController@create'          )->name('user.create');
Route::post('/usernew',         	               			   'User\UserController@store'           );
Route::match(['get', 'post'],'/usersAll',        			   'User\UserController@usersAll'        );
Route::match(['get', 'post'],'/userDetails',     			   'User\UserController@userDetails'     );
Route::match(['get', 'post'],'/user/rolDetails',         'User\UserController@rolDetails'      );
Route::match(['get', 'post'],'/user/rolDetailsSelect',   'User\UserController@rolDetailsSelect');
Route::match(['get', 'post'],'/user/updateRolUser',      'User\UserController@updateRolUser'   );
Route::match(['get', 'post'],'/user/validUser',          'User\UserController@validUser'       );
Route::match(['get', 'post'],'/user/updatePassword',     'User\UserController@updatePassword'  );
Route::match(['get', 'post'],'/user/updateStatus',       'User\UserController@updateStatus'    );
Route::match(['get', 'post'],'/user/validUserDni',       'User\UserController@validUser'       );
Route::match(['get', 'post'],'/user/PermisosDetails',    'User\UserController@PermisosDetails' );
Route::match(['get', 'post'],'/user/updatePermisoUser',  'User\UserController@updatePermisoUser');


Route::resource('menus',                              'General\MenuController'         );
Route::resource('rol-menus',                          'General\MenuController'         );
Route::match(['get', 'post'], '/getMains',            'General\MenuController@getMains')->name('menus.get');

Route::resource('roles',                              'General\TpRolController'             );
Route::match(['get', 'post'], '/updateStatusTpRols',  'General\TpRolController@updateStatus');
Route::match(['get', 'post'], '/getTpRols',           'General\TpRolController@getTpRols'   );

Route::resource('rol-menus',                          'General\RolMenuController'             );
Route::match(['get', 'post'], '/getRolMain',          'General\RolMenuController@getRolMain'  )->name('rol-menus.get');
Route::match(['get', 'post'], '/updateStatusRolMenu', 'General\RolMenuController@updateStatus');

Route::resource('estatus-recargas',                   'General\StatusRecargaController');

//DIRECCIONES
//TIPO PAIS
Route::resource('pais',                         'General\CountryController');
Route::match(['get', 'post'],'/getCountries',   'General\CountryController@get');
Route::match(['get', 'post'],'/statusCountries','General\CountryController@status');
//TIPO DEPARTAMENTO
Route::resource('estados',                      'General\DepartamentController');
Route::match(['get', 'post'],'/getEstados',     'General\DepartamentController@get');
Route::match(['get', 'post'],'/statusEstados',  'General\DepartamentController@status');
//TIPO CITY
Route::resource('ciudad',                       'General\CityController');
Route::match(['get', 'post'],'/getCities',      'General\CityController@getCities');
Route::match(['get', 'post'],'/statusCities',   'General\CityController@status');


Route::resource('saldos',                           'Driver\SaldoController');
Route::match(['get', 'post'], '/getDataSaldo',      'Driver\SaldoController@getData');
Route::match(['get', 'post'], '/updateStatusSaldo', 'Driver\SaldoController@updateStatus');

Route::match(['get', 'post'], '/searchConductor',    'Apis\ConexionCondController@searchConductor');
Route::match(['get', 'post'], '/getDataConductorId', 'Apis\ConexionCondController@searchConductorNames');


//RECARGAS
Route::match(['get', 'post'], '/recargas-pendientes',   'Driver\RecargaController@pendientes');
Route::match(['get', 'post'], '/getDataPendientes',     'Driver\RecargaController@getDataPendientes');
Route::match(['get', 'post'], '/getDataRecargaId',      'Driver\RecargaController@getDataRecargaId');


Route::match(['get', 'post'], '/recargas-generales',        'Driver\RecargaController@generales');
Route::match(['get', 'post'], '/getDataGenerales',          'Driver\RecargaController@getDataGenerales');
Route::match(['get', 'post'], '/sendFormData',              'Driver\RecargaController@sendFormData');

//APIS
Route::match(['get', 'post'], '/getConductorPeru/{query}',   'Apis\ConexionCondController@getConductorPeru');


});//FIN DE SESSION
