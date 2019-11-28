<?php 
	
	Route::post('crear_cuenta','CuentaController@crear');
	Route::get('traer_cuenta','CuentaController@traer_cuenta');

	Route::post('ingresar_subcuenta','SubCuentaController@insertar');
	Route::get('traer_subcuenta/{id}','SubCuentaController@traer_subcuenta');


	Route::post('insertar_cuenta_detalle','CuentadescripcionController@crear');
	Route::get('listar_cuenta_detalle/{mes}/{anio}/{cuenta}','CuentadescripcionController@listar');
	Route::post('ini_cie_ingresar','InicioCierreController@ingresar');
	Route::get('traer_inicio_mensual/{mes}/{anio}/{cuenta}','InicioCierreController@traer_inicio_mensual');
	Route::post('actualizar_cuenta_detalle','CuentadescripcionController@actualizar');
	Route::post('actualizar_cuenta_detalle_archivo','CuentadescripcionController@actualizar_archivo');
	Route::get('eliminar_cuenta_detalle/{id}','CuentadescripcionController@eliminar_cuenta_detalle');

	Route::get('select_nombre','LiquidacionesController@select_nombre');
	Route::get('traer_datos_persona/{id}','LiquidacionesController@traer_datos_persona');
	
	

	
 ?>