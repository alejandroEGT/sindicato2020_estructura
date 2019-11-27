<?php 
	
	Route::post('crear_cuenta','CuentaController@crear');
	Route::get('traer_cuenta','CuentaController@traer_cuenta');

	Route::post('ingresar_subcuenta','SubCuentaController@insertar');
	Route::get('traer_subcuenta/{id}','SubCuentaController@traer_subcuenta');


	Route::post('insertar_cuenta_detalle','CuentadescripcionController@crear');
	Route::get('listar_cuenta_detalle/{mes}/{anio}/{cuenta}','CuentadescripcionController@listar');

	
 ?>